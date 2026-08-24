<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /** Menampilkan rekap operasional perpustakaan untuk petugas. */
    public function index(Request $request): View
    {
        Peminjaman::tandaiTerlambat();

        $validated = $request->validate([
            'mulai' => ['nullable', 'date'],
            'sampai' => ['nullable', 'date', 'after_or_equal:mulai'],
        ]);

        $mulai = $validated['mulai'] ?? now()->startOfMonth()->toDateString();
        $sampai = $validated['sampai'] ?? now()->endOfMonth()->toDateString();

        $peminjamanDalamPeriode = Peminjaman::query()
            ->whereBetween('tanggal_pinjam', [$mulai, $sampai]);

        $ringkasan = [
            'peminjaman' => (clone $peminjamanDalamPeriode)->count(),
            'dikembalikan' => (clone $peminjamanDalamPeriode)->where('status', 'Dikembalikan')->count(),
            'terlambat' => (clone $peminjamanDalamPeriode)->where('status', 'Terlambat')->count(),
            'kunjungan' => Kunjungan::query()->whereBetween('tanggal', [$mulai, $sampai])->count(),
            'pengembalian' => Pengembalian::query()->whereBetween('tanggal_kembali', [$mulai, $sampai])->count(),
        ];

        $peminjaman = (clone $peminjamanDalamPeriode)
            ->with(['anggota:id,nama,role,nis_nisn,nip', 'detailPeminjaman.buku:id,judul', 'pengembalian'])
            ->latest('tanggal_pinjam')
            ->paginate(15)
            ->withQueryString();

        $bukuTerpopuler = DB::table('detail_peminjaman')
            ->join('peminjaman', 'detail_peminjaman.peminjaman_id', '=', 'peminjaman.id')
            ->join('buku', 'detail_peminjaman.buku_id', '=', 'buku.id')
            ->whereBetween('peminjaman.tanggal_pinjam', [$mulai, $sampai])
            ->select('buku.judul', DB::raw('SUM(detail_peminjaman.jumlah) as total_dipinjam'))
            ->groupBy('buku.id', 'buku.judul')
            ->orderByDesc('total_dipinjam')
            ->limit(5)
            ->get();

        return view('laporan.index', compact('mulai', 'sampai', 'ringkasan', 'peminjaman', 'bukuTerpopuler'));
    }
}
