<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePenggantianBukuRequest;
use App\Models\Buku;
use App\Models\PenggantianBuku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PenggantianBukuController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->value();

        $penggantian = PenggantianBuku::query()
            ->with(['pengembalian.peminjaman.anggota'])
            ->when(in_array($status, ['Menunggu', 'Diverifikasi', 'Selesai'], true), fn ($query) => $query->where('status', $status))
            ->latest('tanggal_lapor')
            ->paginate(12)
            ->withQueryString();

        return view('penggantian.index', compact('penggantian', 'status'));
    }

    public function edit(PenggantianBuku $penggantian): View
    {
        return view('penggantian.form', [
            'penggantian' => $penggantian->load(['pengembalian.peminjaman.anggota']),
        ]);
    }

    public function update(UpdatePenggantianBukuRequest $request, PenggantianBuku $penggantian): RedirectResponse
    {
        DB::transaction(function () use ($request, $penggantian): void {
            $penggantian = PenggantianBuku::query()
                ->with('pengembalian.peminjaman.detailPeminjaman')
                ->lockForUpdate()
                ->findOrFail($penggantian->id);
            $peminjaman = $penggantian->pengembalian->peminjaman;
            $data = $request->validated();

            if ($penggantian->status === 'Selesai' && $data['status'] !== 'Selesai') {
                throw ValidationException::withMessages(['status' => 'Penggantian yang telah selesai tidak dapat dibuka kembali.']);
            }

            if ($data['status'] === 'Selesai' && $penggantian->status !== 'Selesai') {
                if ($peminjaman->status !== 'Penggantian Buku') {
                    throw ValidationException::withMessages(['status' => 'Status transaksi peminjaman tidak sesuai untuk menyelesaikan penggantian.']);
                }

                foreach ($peminjaman->detailPeminjaman as $detail) {
                    $buku = Buku::withTrashed()->lockForUpdate()->findOrFail($detail->buku_id);
                    $buku->increment('stok', $detail->jumlah);
                    $buku->increment('stok_tersedia', $detail->jumlah);
                }

                $data['tanggal_selesai'] = today();
                $peminjaman->update(['status' => 'Dikembalikan']);
            }

            $penggantian->update($data);
        });

        return redirect()->route('penggantian.index')->with('success', 'Data penggantian buku berhasil diperbarui.');
    }
}
