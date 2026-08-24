<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmPeminjamanRequest;
use App\Http\Requests\StorePeminjamanRequest;
use App\Models\Buku;
use App\Models\DetailPeminjaman;
use App\Models\Peminjaman;
use App\Models\Notifikasi;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PeminjamanController extends Controller
{
    public function index(Request $request): View
    {
        abort_unless(auth('anggota')->check(), 403);

        Peminjaman::tandaiTerlambat();

        $peminjaman = Peminjaman::query()
            ->with(['detailPeminjaman.buku', 'petugas', 'pengembalian'])
            ->where('anggota_id', auth('anggota')->id())
            ->latest()
            ->paginate(10);

        return view('peminjaman.riwayat', compact('peminjaman'));
    }

    public function create(Request $request): View
    {
        abort_unless(auth('anggota')->check(), 403);

        $anggota = auth('anggota')->user();
        $buku = Buku::query()
            ->where('status', 'Tersedia')
            ->where('stok_tersedia', '>', 0)
            ->orderBy('judul')
            ->get(['id', 'judul', 'penulis', 'jenis_buku', 'stok_tersedia']);

        return view('peminjaman.form', [
            'anggota' => $anggota,
            'buku' => $buku,
            'selectedBukuId' => $request->integer('buku_id'),
        ]);
    }

    public function store(StorePeminjamanRequest $request): RedirectResponse
    {
        $anggota = auth('anggota')->user();

        if (! $anggota->bisaMeminjam()) {
            return back()->withErrors(['buku_id' => 'Status keanggotaan tidak memenuhi syarat untuk melakukan peminjaman.'])->withInput();
        }

        DB::transaction(function () use ($request, $anggota): void {
            $buku = Buku::query()->lockForUpdate()->findOrFail($request->integer('buku_id'));

            if ($buku->status !== 'Tersedia' || $buku->stok_tersedia < 1) {
                throw ValidationException::withMessages(['buku_id' => 'Buku sedang tidak tersedia.']);
            }

            if ($buku->jenis_buku === 'Umum' && $this->jumlahBukuUmumBerjalan($anggota->id) >= 3) {
                throw ValidationException::withMessages(['buku_id' => 'Kuota peminjaman telah mencapai batas maksimal.']);
            }

            $peminjaman = Peminjaman::create([
                'anggota_id' => $anggota->id,
                'jenis_peminjaman' => $buku->jenis_buku,
                'status' => 'Menunggu',
            ]);

            $peminjaman->detailPeminjaman()->create(['buku_id' => $buku->id, 'jumlah' => 1]);
        });

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim dan menunggu konfirmasi petugas.');
    }

    public function petugasIndex(Request $request): View
    {
        Peminjaman::tandaiTerlambat();

        $search = $request->string('cari')->trim()->value();
        $status = $request->string('status')->value();

        $peminjaman = Peminjaman::query()
            ->with(['anggota:id,nama,role,nis_nisn,nip', 'detailPeminjaman.buku', 'petugas'])
            ->when($search, fn ($query) => $query->whereHas('anggota', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis_nisn', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            }))
            ->when(in_array($status, ['Menunggu', 'Dipinjam', 'Dikembalikan', 'Terlambat', 'Penggantian Buku'], true), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('peminjaman.konfirmasi', compact('peminjaman', 'search', 'status'));
    }

    public function confirmForm(Peminjaman $peminjaman): View
    {
        Peminjaman::tandaiTerlambat();
        abort_unless($peminjaman->status === 'Menunggu', 404);

        return view('peminjaman.confirm', ['peminjaman' => $peminjaman->load(['anggota', 'detailPeminjaman.buku'])]);
    }

    public function confirm(ConfirmPeminjamanRequest $request, Peminjaman $peminjaman): RedirectResponse
    {
        DB::transaction(function () use ($request, $peminjaman): void {
            $peminjaman = Peminjaman::query()
                ->with(['anggota', 'detailPeminjaman'])
                ->lockForUpdate()
                ->findOrFail($peminjaman->id);

            if ($peminjaman->status !== 'Menunggu') {
                throw ValidationException::withMessages(['tanggal_pinjam' => 'Pengajuan ini sudah diproses.']);
            }

            if (! $peminjaman->anggota->bisaMeminjam()) {
                throw ValidationException::withMessages(['tanggal_pinjam' => 'Status anggota tidak lagi memenuhi syarat peminjaman.']);
            }

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::query()->lockForUpdate()->findOrFail($detail->buku_id);

                if ($buku->status !== 'Tersedia' || $buku->stok_tersedia < $detail->jumlah) {
                    throw ValidationException::withMessages(['tanggal_pinjam' => "Stok buku {$buku->judul} sudah tidak tersedia."]);
                }

                $buku->decrement('stok_tersedia', $detail->jumlah);
            }

            $peminjaman->update([
                ...$request->validated(),
                'petugas_id' => auth('petugas')->id(),
                'status' => 'Dipinjam',
            ]);
            Notifikasi::create(['anggota_id' => $peminjaman->anggota_id, 'judul' => 'Peminjaman dikonfirmasi', 'pesan' => 'Pengajuan peminjaman Anda telah dikonfirmasi. Jatuh tempo: '.$peminjaman->tanggal_jatuh_tempo->format('d M Y').'.', 'tipe' => 'Peminjaman', 'tautan' => route('peminjaman.index')]);
            ActivityLogger::log("Mengonfirmasi peminjaman #{$peminjaman->id}", 'Peminjaman');
        });

        return redirect()->route('peminjaman.petugas.index')->with('success', 'Peminjaman berhasil dikonfirmasi dan stok buku telah diperbarui.');
    }

    private function jumlahBukuUmumBerjalan(int $anggotaId): int
    {
        return DetailPeminjaman::query()
            ->whereHas('peminjaman', fn ($query) => $query
                ->where('anggota_id', $anggotaId)
                ->where('jenis_peminjaman', 'Umum')
                ->whereIn('status', ['Menunggu', 'Dipinjam', 'Terlambat', 'Penggantian Buku']))
            ->sum('jumlah');
    }
}
