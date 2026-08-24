<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';

    protected $fillable = ['peminjaman_id', 'buku_id', 'jumlah'];

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function buku(): BelongsTo
    {
        // Riwayat transaksi harus tetap dapat dibaca apabila koleksi diarsipkan
        // (soft delete) setelah transaksi selesai.
        return $this->belongsTo(Buku::class, 'buku_id')->withTrashed();
    }
}
