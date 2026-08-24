<?php

/*
======================================================
Nama File : DashboardController.php
Fungsi : Menampilkan halaman awal sesuai peran pengguna.
Bagian yang boleh diubah : Judul, deskripsi, dan data tampilan.
Bagian yang harus berhati-hati : Nama view dan data pengguna.
Bagian yang tidak boleh diubah : Middleware route yang melindungi dashboard.
Risiko : Perubahan akses dapat menampilkan halaman kepada peran yang salah.
======================================================
*/

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Kunjungan;
use App\Models\Peminjaman;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /* BOLEH DIUBAH: isi informasi dashboard dasar. */
    public function petugas(): View
    {
        Peminjaman::tandaiTerlambat();
        $stats = ['total_buku'=>Buku::count(), 'total_anggota'=>Anggota::count(), 'buku_tersedia'=>Buku::sum('stok_tersedia'), 'buku_dipinjam'=>max(0, Buku::sum('stok')-Buku::sum('stok_tersedia')), 'peminjaman_aktif'=>Peminjaman::whereIn('status',['Dipinjam','Terlambat'])->count(), 'terlambat'=>Peminjaman::where('status','Terlambat')->count(), 'kunjungan_hari_ini'=>Kunjungan::whereDate('tanggal',today())->count()];
        $aktivitas = Peminjaman::with('anggota:id,nama')->latest()->take(5)->get();
        $pengumuman = Pengumuman::where('status','Aktif')->whereDate('tanggal_publish','<=',today())->where(fn($q)=>$q->whereNull('tanggal_berakhir')->orWhereDate('tanggal_berakhir','>=',today()))->latest('tanggal_publish')->take(3)->get();
        $chartData = $this->chartData(Peminjaman::query());
        return view('dashboard', compact('stats','aktivitas','pengumuman','chartData') + ['title' => 'Dashboard Petugas', 'user' => auth('petugas')->user()]);
    }

    /* BOLEH DIUBAH: isi informasi dashboard dasar. */
    public function siswa(): View
    {
        return $this->anggotaDashboard('Dashboard Siswa');
    }

    /* BOLEH DIUBAH: isi informasi dashboard dasar. */
    public function guruKaryawan(): View
    {
        return $this->anggotaDashboard('Dashboard Guru / Karyawan');
    }

    /** Menampilkan data sumber untuk statistik yang dipilih petugas. */
    public function statistik(Request $request, string $jenis): View
    {
        Peminjaman::tandaiTerlambat();
        $titles = ['total_buku' => 'Seluruh Koleksi Buku', 'total_anggota' => 'Seluruh Anggota', 'buku_tersedia' => 'Buku yang Tersedia', 'buku_dipinjam' => 'Koleksi yang Sedang Dipinjam', 'peminjaman_aktif' => 'Peminjaman Aktif', 'terlambat' => 'Peminjaman Terlambat', 'kunjungan_hari_ini' => 'Kunjungan Hari Ini', 'peminjaman_bulan' => 'Peminjaman per Bulan', 'status_peminjaman' => 'Status Peminjaman'];
        abort_unless(array_key_exists($jenis, $titles), 404);

        $viewType = 'peminjaman';
        if (in_array($jenis, ['total_buku', 'buku_tersedia', 'buku_dipinjam'], true)) {
            $viewType = 'buku';
            $data = Buku::with('kategori:id,nama_kategori')->when($jenis === 'buku_tersedia', fn ($query) => $query->where('stok_tersedia', '>', 0))->when($jenis === 'buku_dipinjam', fn ($query) => $query->whereColumn('stok', '>', 'stok_tersedia'))->orderBy('judul')->paginate(15)->withQueryString();
        } elseif ($jenis === 'total_anggota') {
            $viewType = 'anggota';
            $data = Anggota::withCount(['peminjaman', 'kunjungan'])->orderBy('nama')->paginate(15)->withQueryString();
        } elseif ($jenis === 'kunjungan_hari_ini') {
            $viewType = 'kunjungan';
            $data = Kunjungan::with('anggota:id,nama,role,kelas,jurusan,nip')->whereDate('tanggal', today())->latest('jam_masuk')->paginate(15)->withQueryString();
        } else {
            $query = Peminjaman::with(['anggota:id,nama,role,kelas,jurusan,nip', 'detailPeminjaman.buku:id,judul'])->latest('tanggal_pinjam');
            if ($jenis === 'peminjaman_aktif') $query->whereIn('status', ['Dipinjam', 'Terlambat']);
            if ($jenis === 'terlambat') $query->where('status', 'Terlambat');
            if ($jenis === 'status_peminjaman') $query->where('status', $request->string('status')->value());
            if ($jenis === 'peminjaman_bulan') {
                $bulan = $request->string('bulan')->value();
                abort_unless(preg_match('/^\\d{4}-\\d{2}$/', $bulan) === 1, 404);
                $tanggal = now()->createFromFormat('Y-m', $bulan);
                $query->whereBetween('created_at', [$tanggal->copy()->startOfMonth(), $tanggal->copy()->endOfMonth()]);
            }
            $data = $query->paginate(15)->withQueryString();
        }

        $title = $titles[$jenis];
        return view('dashboard.statistik-detail', compact('title', 'jenis', 'viewType', 'data'));
    }

    private function anggotaDashboard(string $title): View { $user=auth('anggota')->user(); Peminjaman::tandaiTerlambat(); $stats=['aktif'=>$user->peminjaman()->whereIn('status',['Menunggu','Dipinjam','Terlambat'])->count(),'terlambat'=>$user->peminjaman()->where('status','Terlambat')->count(),'kunjungan'=>$user->kunjungan()->count()]; $aktivitas=$user->peminjaman()->with('detailPeminjaman.buku')->latest()->take(5)->get(); $pengumuman=Pengumuman::where('status','Aktif')->whereDate('tanggal_publish','<=',today())->where(fn($q)=>$q->whereNull('tanggal_berakhir')->orWhereDate('tanggal_berakhir','>=',today()))->latest('tanggal_publish')->take(3)->get(); $unreadNotifications=$user->notifikasi()->where('status_baca','Belum Dibaca')->count(); $chartData=$this->chartData($user->peminjaman()); return view('dashboard',compact('title','user','stats','aktivitas','pengumuman','unreadNotifications','chartData')); }

    /** Data ringan untuk visualisasi enam bulan terakhir di dashboard. */
    private function chartData($peminjaman): array
    {
        $months = collect(range(5, 0))->map(function (int $offset) use ($peminjaman) {
            $date = now()->subMonths($offset);
            return [
                'label' => $date->translatedFormat('M'),
                'month' => $date->format('Y-m'),
                'value' => (clone $peminjaman)->whereBetween('created_at', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])->count(),
            ];
        });

        $status = collect(['Menunggu', 'Dipinjam', 'Dikembalikan', 'Terlambat'])
            ->map(fn (string $label) => ['label' => $label, 'value' => (clone $peminjaman)->where('status', $label)->count()])
            ->values();

        return compact('months', 'status');
    }
}
