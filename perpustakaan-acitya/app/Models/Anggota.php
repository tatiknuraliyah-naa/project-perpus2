<?php

/*
======================================================
Nama File : Anggota.php
Fungsi : Model akun siswa, guru, dan karyawan.
Bagian yang boleh diubah : Pesan/dokumentasi dan relasi tambahan.
Bagian yang harus berhati-hati : Fillable, casts, relasi, dan status.
Bagian yang tidak boleh diubah : Pewarisan Authenticatable untuk login.
Risiko : Mengubah autentikasi atau status dapat mengganggu akses anggota.
======================================================
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 'anggota';

    /* BOLEH DIUBAH DENGAN HATI-HATI: kolom yang dapat diisi massal. */
    protected $fillable = [
        'role', 'nama', 'nis_nisn', 'nip', 'kelas', 'jurusan',
        'jabatan', 'email', 'no_hp', 'foto', 'password', 'status',
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

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'anggota_id');
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }

    public function achievementPengguna(): HasMany
    {
        return $this->hasMany(AchievementPengguna::class, 'anggota_id');
    }

    public function leaderboard(): HasMany
    {
        return $this->hasMany(Leaderboard::class, 'anggota_id');
    }

    public function notifikasi(): HasMany
    {
        return $this->hasMany(Notifikasi::class, 'anggota_id');
    }

    public function logAktivitas(): HasMany
    {
        return $this->hasMany(LogAktivitas::class, 'anggota_id');
    }

    /**
     * Aturan bisnis: hanya anggota berstatus Aktif yang boleh meminjam.
     * (PRD §2.7 — Alumni tidak dapat melakukan peminjaman baru)
     */
    public function bisaMeminjam(): bool
    {
        return $this->status === 'Aktif';
    }
}
