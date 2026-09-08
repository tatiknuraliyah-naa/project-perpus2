<?php

/*
======================================================
Nama File : EnsureRole.php
Fungsi : Membatasi halaman sesuai peran pengguna yang telah login.
Bagian yang boleh diubah : Pesan penolakan akses.
Bagian yang harus berhati-hati : Daftar role dan nama guard.
Bagian yang tidak boleh diubah : Proses pengecekan autentikasi dan abort 403.
Risiko : Perubahan yang salah dapat membuka akses tanpa izin.
======================================================
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRole
{
    /*
    ==================================================
    JANGAN DIUBAH
    Inti pembatasan akses halaman berdasarkan guard dan role.
    ==================================================
    */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (auth('petugas')->check() && in_array('petugas', $roles, true)) {
            return $next($request);
        }

        if (auth('anggota')->check()) {
            $anggota = auth('anggota')->user();

            if (in_array(strtolower($anggota->role), $roles, true)) {
                return $next($request);
            }
        }

        if (! auth('petugas')->check() && ! auth('anggota')->check() && $request->routeIs('katalog.*')) {
            return redirect()
                ->guest(route('login'))
                ->with('login_notice', 'Silakan login terlebih dahulu untuk mengakses katalog.');
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}
