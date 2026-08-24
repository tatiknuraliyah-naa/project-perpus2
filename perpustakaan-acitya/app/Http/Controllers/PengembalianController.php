<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengembalianRequest;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\PenggantianBuku;
use App\Models\Notifikasi;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PengembalianController extends Controller
{
    public function index(Request $request): View
    {
        Peminjaman::tandaiTerlambat();

        $search = $request->string('cari')->trim()->value();

        $peminjaman = Peminjaman::query()
            ->with(['anggota:id,nama,role,nis_nisn,nip', 'detailPeminjaman.buku'])
            ->whereIn('status', ['Dipinjam', 'Terlambat'])
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->whereHas('anggota', fn ($query) => $query
                    ->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis_nisn', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%"))
                    ->orWhere('id', $search);
            }))
            ->orderBy('tanggal_jatuh_tempo')
            ->paginate(12)
            ->withQueryString();

        return view('pengembalian.index', compact('peminjaman', 'search'));
    }

    public function create(Peminjaman $peminjaman): View
    {
        Peminjaman::tandaiTerlambat();
        $peminjaman->refresh();
        abort_unless(in_array($peminjaman->status, ['Dipinjam', 'Terlambat'], true), 404);

        return view('pengembalian.form', [
            'peminjaman' => $peminjaman->load(['anggota', 'detailPeminjaman.buku']),
        ]);
    }

    public function store(StorePengembalianRequest $request, Peminjaman $peminjaman): RedirectResponse
    {
        DB::transaction(function () use ($request, $peminjaman): void {
            $peminjaman = Peminjaman::query()
                ->with(['detailPeminjaman', 'pengembalian'])
                ->lockForUpdate()
                ->findOrFail($peminjaman->id);

            if (! in_array($peminjaman->status, ['Dipinjam', 'Terlambat'], true)) {
                throw ValidationException::withMessages(['tanggal_kembali' => 'Transaksi ini tidak dapat dikembalikan karena statusnya sudah berubah.']);
            }

            if ($peminjaman->pengembalian()->exists()) {
                throw ValidationException::withMessages(['tanggal_kembali' => 'Buku telah dikembalikan sebelumnya.']);
            }

            $data = $request->validated();
            if ($peminjaman->tanggal_pinjam && $data['tanggal_kembali'] < $peminjaman->tanggal_pinjam->toDateString()) {
                throw ValidationException::withMessages(['tanggal_kembali' => 'Tanggal pengembalian tidak boleh lebih awal dari tanggal pinjam.']);
            }

            $pengembalian = Pengembalian::create([
                ...$data,
                'peminjaman_id' => $peminjaman->id,
                'petugas_id' => auth('petugas')->id(),
            ]);

            if ($data['kondisi'] === 'Hilang') {
                foreach ($peminjaman->detailPeminjaman as $detail) {
                    $buku = Buku::withTrashed()->lockForUpdate()->findOrFail($detail->buku_id);

                    if ($buku->stok < $detail->jumlah) {
                        throw ValidationException::withMessages(['kondisi' => "Stok total {$buku->judul} tidak valid untuk mencatat buku hilang."]);
                    }

                    // Eksemplar fisik sudah hilang; stok tersedia memang telah
                    // berkurang saat dipinjam dan tidak boleh dikembalikan di sini.
                    $buku->decrement('stok', $detail->jumlah);
                }

                PenggantianBuku::create([
                    'pengembalian_id' => $pengembalian->id,
                    'buku_hilang' => $peminjaman->detailPeminjaman
                        ->map(fn ($detail) => Buku::withTrashed()->find($detail->buku_id)?->judul ?? "Buku #{$detail->buku_id}")
                        ->implode(', '),
                    'tanggal_lapor' => $data['tanggal_kembali'],
                    'status' => 'Menunggu',
                    'catatan' => $data['catatan'] ?? null,
                ]);
                $peminjaman->update(['status' => 'Penggantian Buku']);
                Notifikasi::create(['anggota_id' => $peminjaman->anggota_id, 'judul' => 'Pengembalian memerlukan penggantian', 'pesan' => 'Buku hilang telah dicatat dan menunggu proses penggantian.', 'tipe' => 'Pengembalian', 'tautan' => route('peminjaman.index')]);
                ActivityLogger::log("Mencatat kehilangan pada peminjaman #{$peminjaman->id}", 'Pengembalian');

                return;
            }

            foreach ($peminjaman->detailPeminjaman as $detail) {
                $buku = Buku::withTrashed()->lockForUpdate()->findOrFail($detail->buku_id);

                if ($data['kondisi'] === 'Rusak Berat') {
                    // Eksemplar yang tidak layak edar dikeluarkan dari koleksi;
                    // stok tersedia tidak berubah karena sebelumnya sedang dipinjam.
                    if ($buku->stok < $detail->jumlah) {
                        throw ValidationException::withMessages(['kondisi' => "Stok total {$buku->judul} tidak valid untuk mencatat buku rusak berat."]);
                    }

                    $buku->decrement('stok', $detail->jumlah);

                    continue;
                }

                $buku->increment('stok_tersedia', $detail->jumlah);
            }

            $peminjaman->update(['status' => 'Dikembalikan']);
            Notifikasi::create(['anggota_id' => $peminjaman->anggota_id, 'judul' => 'Pengembalian berhasil dicatat', 'pesan' => 'Pengembalian buku Anda telah dicatat oleh petugas.', 'tipe' => 'Pengembalian', 'tautan' => route('peminjaman.index')]);
            ActivityLogger::log("Mencatat pengembalian peminjaman #{$peminjaman->id}", 'Pengembalian');
        });

        $pesan = $request->string('kondisi')->value() === 'Hilang'
            ? 'Pengembalian tercatat sebagai buku hilang. Transaksi dialihkan ke proses penggantian buku.'
            : ($request->string('kondisi')->value() === 'Rusak Berat'
                ? 'Pengembalian buku rusak berat tercatat. Eksemplar dikeluarkan dari stok tersedia.'
                : 'Pengembalian berhasil dicatat dan stok buku telah diperbarui.');

        return redirect()->route('pengembalian.index')->with('success', $pesan);
    }
}
