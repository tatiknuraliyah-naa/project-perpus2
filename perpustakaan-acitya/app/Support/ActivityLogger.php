<?php

namespace App\Support;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class ActivityLogger
{
    public static function log(string $aktivitas, string $modul, ?Request $request = null): void
    {
        $request ??= request();
        LogAktivitas::create([
            'petugas_id' => auth('petugas')->id(),
            'anggota_id' => auth('anggota')->id(),
            'aktivitas' => $aktivitas,
            'modul' => $modul,
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]);
    }
}
