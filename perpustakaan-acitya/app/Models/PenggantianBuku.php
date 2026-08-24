<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenggantianBuku extends Model
{
    use HasFactory;

    protected $table = 'penggantian_buku';

    protected $fillable = [
        'pengembalian_id', 'buku_hilang', 'buku_pengganti',
        'tanggal_lapor', 'tanggal_selesai', 'status', 'catatan',
    ];

    protected $casts = [
        'tanggal_lapor' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function pengembalian(): BelongsTo
    {
        return $this->belongsTo(Pengembalian::class, 'pengembalian_id');
    }
}
