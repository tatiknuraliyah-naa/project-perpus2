<?php

/*
======================================================
Nama File : web.php
Fungsi : Mendefinisikan route web dan proteksi akses berdasarkan peran.
Bagian yang boleh diubah : Nama route, teks halaman, dan route fitur baru.
Bagian yang harus berhati-hati : Middleware serta nama route yang dipakai controller.
Bagian yang tidak boleh diubah : Route login, logout, dan proteksi role dashboard.
Risiko : Kesalahan route/middleware dapat membuka akses tanpa izin atau membuat redirect gagal.
======================================================
*/

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PenggantianBukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\QrKunjunganController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* BOLEH DIUBAH: halaman depan sementara dapat diganti landing page. */
Route::redirect('/', '/login');

/* JANGAN DIUBAH: gerbang autentikasi utama. */
Route::middleware('guest:petugas,anggota')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
});

/* JANGAN DIUBAH: logout harus selalu memakai method POST dan CSRF. */
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

/* JANGAN DIUBAH: setiap dashboard dibatasi oleh role yang sesuai. */
Route::middleware('role:petugas')->get('/dashboard/petugas', [DashboardController::class, 'petugas'])->name('dashboard.petugas');
Route::middleware('role:petugas')->get('/dashboard/petugas/statistik/{jenis}', [DashboardController::class, 'statistik'])->name('dashboard.petugas.statistik');
Route::middleware('role:siswa')->get('/dashboard/siswa', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
Route::middleware('role:guru,karyawan')->get('/dashboard/guru-karyawan', [DashboardController::class, 'guruKaryawan'])->name('dashboard.guru-karyawan');

/* Katalog dapat dibaca oleh seluruh pengguna yang telah login. */
Route::middleware('role:petugas,siswa,guru,karyawan')->group(function () {
    Route::get('/katalog', [BukuController::class, 'catalog'])->name('katalog.index');
    Route::get('/katalog/{buku}', [BukuController::class, 'showCatalog'])->name('katalog.show');
    Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
    Route::get('/kunjungan/isi', [KunjunganController::class, 'create'])->name('kunjungan.create');
    Route::post('/kunjungan', [KunjunganController::class, 'store'])->name('kunjungan.store');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{notifikasi}/baca', [NotifikasiController::class, 'read'])->name('notifikasi.read');
});

Route::get('/kunjungan/scan/{token:token}', [QrKunjunganController::class, 'scan'])->middleware('role:siswa,guru,karyawan')->name('qr-kunjungan.scan');
Route::post('/kunjungan/scan/{token:token}', [QrKunjunganController::class, 'record'])->middleware('role:siswa,guru,karyawan')->name('qr-kunjungan.record');

Route::middleware('role:siswa,guru,karyawan')->group(function () {
    Route::get('/kunjungan/scan', [QrKunjunganController::class, 'camera'])->name('qr-kunjungan.camera');
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/ajukan', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
});

/* Manajemen koleksi hanya dapat diakses petugas perpustakaan. */
Route::middleware('role:petugas')->group(function () {
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('/pengembalian/{peminjaman}', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::post('/pengembalian/{peminjaman}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('/penggantian-buku', [PenggantianBukuController::class, 'index'])->name('penggantian.index');
    Route::get('/penggantian-buku/{penggantian}/edit', [PenggantianBukuController::class, 'edit'])->name('penggantian.edit');
    Route::put('/penggantian-buku/{penggantian}', [PenggantianBukuController::class, 'update'])->name('penggantian.update');
    Route::get('/peminjaman/konfirmasi', [PeminjamanController::class, 'petugasIndex'])->name('peminjaman.petugas.index');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/peminjaman/{peminjaman}/konfirmasi', [PeminjamanController::class, 'confirmForm'])->name('peminjaman.confirm.form');
    Route::put('/peminjaman/{peminjaman}/konfirmasi', [PeminjamanController::class, 'confirm'])->name('peminjaman.confirm');
    Route::resource('anggota', AnggotaController::class)
        ->parameters(['anggota' => 'anggota'])
        ->except('show');
    Route::resource('kategori', KategoriController::class)->except('show');
    Route::resource('buku', BukuController::class)->except('show');
    // Alias lama agar tautan /q-kunjungan tetap mengarah ke fitur QR yang benar.
    Route::redirect('/q-kunjungan', '/qr-kunjungan');
    Route::get('/qr-kunjungan', [QrKunjunganController::class, 'index'])->name('qr-kunjungan.index');
    Route::post('/qr-kunjungan', [QrKunjunganController::class, 'generate'])->name('qr-kunjungan.generate');
    Route::resource('pengumuman', PengumumanController::class)->except('show', 'index');
});

Route::middleware(['role:petugas', 'admin'])->group(function () {
    Route::resource('petugas', PetugasController::class)->except('show');
    Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log-aktivitas.index');
});
