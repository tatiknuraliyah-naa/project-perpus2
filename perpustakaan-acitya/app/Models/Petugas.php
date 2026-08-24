<?php

/*
======================================================
Nama File : Petugas.php
Fungsi : Model akun petugas dan admin perpustakaan.
Bagian yang boleh diubah : Pesan/dokumentasi dan relasi tambahan.
Bagian yang harus berhati-hati : Fillable, casts, dan relasi.
Bagian yang tidak boleh diubah : Pewarisan Authenticatable untuk login.
Risiko : Mengubah autentikasi dapat membuat login petugas gagal.
======================================================
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Petugas extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'petugas';

    /* BOLEH DIUBAH DENGAN HATI-HATI: kolom yang dapat diisi massal. */
    protected $fillable = [
        'nip', 'nama', 'username', 'password', 'email',
        'no_hp', 'foto', 'level', 'status',
    ];

    /* JANGAN DIUBAH: password wajib tersembunyi dari serialisasi. */
    protected $hidden = ['password', 'remember_token'];

    /* JANGAN DIUBAH: password harus selalu di-hash oleh Laravel. */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'petugas_id');
    }

    public function pengembalian(): HasMany
    {
        return $this->hasMany(Pengembalian::class, 'petugas_id');
    }

    public function pengumuman(): HasMany
    {
        return $this->hasMany(Pengumuman::class, 'petugas_id');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'petugas_id');
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'petugas_id');
    }

    public function backupDatabase(): HasMany
    {
        return $this->hasMany(BackupDatabase::class, 'petugas_id');
    }
}
