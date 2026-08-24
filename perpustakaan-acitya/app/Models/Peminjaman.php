<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjaman';

    protected $fillable = [
        'anggota_id', 'petugas_id', 'tanggal_pinjam', 'tanggal_jatuh_tempo',
        'jenis_peminjaman', 'status',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_jatuh_tempo' => 'date',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }

    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'peminjaman_id');
    }

    public function pengembalian(): HasOne
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    /**
     * Menyelaraskan status transaksi aktif yang sudah melewati jatuh tempo.
     * Kondisi ini sengaja hanya mengubah transaksi yang masih Dipinjam agar
     * pengembalian dan penggantian buku tidak pernah tertimpa.
     */
    public static function tandaiTerlambat(): int
    {
        return static::query()
            ->where('status', 'Dipinjam')
            ->whereDate('tanggal_jatuh_tempo', '<', today())
            ->update(['status' => 'Terlambat']);
    }
}
