{{--
======================================================
Nama File : app.blade.php
Fungsi : Layout dasar untuk halaman autentikasi dan dashboard.
Bagian yang boleh diubah : HTML, teks, warna, class CSS, dan layout.
Bagian yang harus berhati-hati : @vite serta form logout dan CSRF.
Bagian yang tidak boleh diubah : Yield konten dan token CSRF pada logout.
Risiko : Menghapus @vite membuat CSS tidak dimuat; menghapus CSRF membuat logout gagal.
======================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Perpustakaan Acitya Wiguna' }}</title>
    {{-- JANGAN DIUBAH: memuat aset Vite Laravel. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="{{ auth('petugas')->check() || auth('anggota')->check() ? 'has-app-shell' : '' }}">
    {{-- Navigasi ditampilkan hanya untuk pengguna yang telah masuk. --}}
    @if (auth('petugas')->check() || auth('anggota')->check())
        @php
            $isPetugas = auth('petugas')->check();
            $dashboardRoute = $isPetugas
                ? route('dashboard.petugas')
                : (auth('anggota')->user()->role === 'Siswa' ? route('dashboard.siswa') : route('dashboard.guru-karyawan'));
        @endphp
        <div class="app-shell">
            <aside class="app-sidebar" id="app-sidebar">
                <a class="brand" href="{{ $dashboardRoute }}"><span class="brand-mark" aria-hidden="true">A</span><span>Acitya<span>Lib</span></span></a>
                <nav class="sidebar-nav" aria-label="Navigasi utama">
                    <p class="nav-label">Utama</p>
                    <a @class(['is-active' => request()->routeIs('dashboard.*')]) href="{{ $dashboardRoute }}"><span aria-hidden="true">▦</span> Dashboard</a>
                    <a @class(['is-active' => request()->routeIs('katalog.*')]) href="{{ route('katalog.index') }}"><span aria-hidden="true">⌕</span> Katalog Buku</a>
                    @if ($isPetugas)
                        <p class="nav-label">Manajemen</p>
                        <a @class(['is-active' => request()->routeIs('buku.*')]) href="{{ route('buku.index') }}"><span aria-hidden="true">▤</span> Data Buku</a>
                        <a @class(['is-active' => request()->routeIs('kategori.*')]) href="{{ route('kategori.index') }}"><span aria-hidden="true">⊞</span> Kategori</a>
                        <a @class(['is-active' => request()->routeIs('anggota.*')]) href="{{ route('anggota.index') }}"><span aria-hidden="true">♙</span> Anggota</a>
                        <p class="nav-label">Layanan</p>
                        <a @class(['is-active' => request()->routeIs('peminjaman.petugas.*', 'peminjaman.confirm.*')]) href="{{ route('peminjaman.petugas.index') }}"><span aria-hidden="true">↗</span> Peminjaman</a>
                        <a @class(['is-active' => request()->routeIs('pengembalian.*')]) href="{{ route('pengembalian.index') }}"><span aria-hidden="true">↙</span> Pengembalian</a>
                        <a @class(['is-active' => request()->routeIs('penggantian.*')]) href="{{ route('penggantian.index') }}"><span aria-hidden="true">⟳</span> Penggantian Buku</a>
                        <a @class(['is-active' => request()->routeIs('kunjungan.*')]) href="{{ route('kunjungan.index') }}"><span aria-hidden="true">◷</span> Kunjungan</a>
                        <a @class(['is-active' => request()->routeIs('laporan.*')]) href="{{ route('laporan.index') }}"><span aria-hidden="true">▥</span> Laporan</a>
                        <p class="nav-label">Lainnya</p>
                        <a @class(['is-active' => request()->routeIs('qr-kunjungan.*')]) href="{{ route('qr-kunjungan.index') }}"><span aria-hidden="true">▣</span> Generator QR</a>
                        <a @class(['is-active' => request()->routeIs('pengumuman.*')]) href="{{ route('pengumuman.index') }}"><span aria-hidden="true">◉</span> Pengumuman</a>
                        @if (auth('petugas')->user()->level === 'Admin')
                            <a @class(['is-active' => request()->routeIs('petugas.*')]) href="{{ route('petugas.index') }}"><span aria-hidden="true">⚙</span> Petugas</a>
                            <a @class(['is-active' => request()->routeIs('log-aktivitas.*')]) href="{{ route('log-aktivitas.index') }}"><span aria-hidden="true">◫</span> Log Aktivitas</a>
                        @endif
                    @else
                        <p class="nav-label">Layanan Saya</p>
                        <a @class(['is-active' => request()->routeIs('peminjaman.*')]) href="{{ route('peminjaman.index') }}"><span aria-hidden="true">↗</span> Peminjaman</a>
                        <a @class(['is-active' => request()->routeIs('kunjungan.*', 'qr-kunjungan.*')]) href="{{ route('kunjungan.index') }}"><span aria-hidden="true">◷</span> Kunjungan</a>
                        <a @class(['is-active' => request()->routeIs('leaderboard.*')]) href="{{ route('leaderboard.index') }}"><span aria-hidden="true">★</span> Leaderboard</a>
                        <a @class(['is-active' => request()->routeIs('pengumuman.*')]) href="{{ route('pengumuman.index') }}"><span aria-hidden="true">◉</span> Pengumuman</a>
                        <a @class(['is-active' => request()->routeIs('notifikasi.*')]) href="{{ route('notifikasi.index') }}"><span aria-hidden="true">●</span> Notifikasi</a>
                    @endif
                </nav>
                <div class="sidebar-footer">
                    <a href="{{ route('profile.edit') }}" class="sidebar-profile"><span class="profile-avatar">{{ strtoupper(mb_substr($isPetugas ? auth('petugas')->user()->nama : auth('anggota')->user()->nama, 0, 1)) }}</span><span><strong>{{ $isPetugas ? auth('petugas')->user()->nama : auth('anggota')->user()->nama }}</strong><small>{{ $isPetugas ? 'Petugas' : auth('anggota')->user()->role }}</small></span></a>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Yakin ingin keluar dari akun?');">@csrf<button type="submit" class="sidebar-logout">Keluar</button></form>
                </div>
            </aside>
            <button class="sidebar-backdrop" type="button" aria-label="Tutup menu"></button>
            <div class="app-content">
                <button class="sidebar-toggle" type="button" aria-controls="app-sidebar" aria-expanded="false">☰ <span>Menu</span></button>
                @yield('content')
            </div>
        </div>
    @else
        @yield('content')
    @endif
    @yield('scripts')
</body>
</html>
