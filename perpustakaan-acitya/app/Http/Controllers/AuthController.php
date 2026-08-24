<?php

/*
======================================================
Nama File : AuthController.php
Fungsi : Menangani login dan logout Petugas, Siswa, Guru, serta Karyawan.
Bagian yang boleh diubah : Teks, label, dan pesan validasi.
Bagian yang harus berhati-hati : Aturan validasi dan pencarian identitas.
Bagian yang tidak boleh diubah : Regenerasi session, guard, dan redirect utama.
Risiko : Mengubah inti autentikasi dapat menyebabkan session tidak aman atau login gagal.
======================================================
*/

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Support\ActivityLogger;

class AuthController extends Controller
{
    /* BOLEH DIUBAH: tampilan dan teks halaman login. */
    public function create(): View
    {
        return view('auth.login');
    }

    /* JANGAN DIUBAH: inti login, verifikasi password, dan keamanan session. */
    public function store(Request $request): RedirectResponse
    {
        /* BOLEH DIUBAH DENGAN HATI-HATI: aturan validasi input login. */
        $credentials = $request->validate([
            'role' => ['required', Rule::in(['Petugas', 'Siswa', 'Guru', 'Karyawan'])],
            'identitas' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string'],
        ]);

        if ($credentials['role'] === 'Petugas') {
            $account = Petugas::where('nip', $credentials['identitas'])
                ->where('status', 'Aktif')
                ->first();
            $guard = 'petugas';
            $dashboard = route('dashboard.petugas');
        } else {
            $identifierColumn = $credentials['role'] === 'Siswa' ? 'nis_nisn' : 'nip';
            $account = Anggota::where('role', $credentials['role'])
                ->where($identifierColumn, $credentials['identitas'])
                ->first();
            $guard = 'anggota';
            $dashboard = $credentials['role'] === 'Siswa'
                ? route('dashboard.siswa')
                : route('dashboard.guru-karyawan');
        }

        /* JANGAN DIUBAH: jangan membedakan pesan agar identitas akun tetap aman. */
        if (! $account || ! Hash::check($credentials['password'], $account->password)) {
            return back()->withErrors(['identitas' => 'NIP atau NIS/NISN tidak ditemukan, atau password salah.'])->onlyInput('role', 'identitas');
        }

        if ($account instanceof Anggota && $account->status === 'Alumni') {
            return back()->withErrors(['identitas' => 'Status akun Anda adalah Alumni sehingga tidak dapat melakukan peminjaman.'])->onlyInput('role', 'identitas');
        }

        if ($account->status !== 'Aktif') {
            return back()->withErrors(['identitas' => 'Akun Anda tidak aktif. Silakan hubungi petugas perpustakaan.'])->onlyInput('role', 'identitas');
        }

        Auth::guard($guard)->login($account);
        $request->session()->regenerate();
        ActivityLogger::log('Login', 'Autentikasi', $request);

        return redirect()->intended($dashboard);
    }

    /* JANGAN DIUBAH: menghapus session login secara aman. */
    public function destroy(Request $request): RedirectResponse
    {
        ActivityLogger::log('Logout', 'Autentikasi', $request);
        Auth::guard('petugas')->logout();
        Auth::guard('anggota')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
