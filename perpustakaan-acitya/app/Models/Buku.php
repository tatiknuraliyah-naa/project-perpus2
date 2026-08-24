<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'buku';

    protected $fillable = [
        'kategori_id', 'kode_buku', 'isbn', 'judul', 'penulis', 'penerbit',
        'tahun_terbit', 'lokasi_rak', 'jenis_buku', 'stok', 'stok_tersedia',
        'cover', 'deskripsi', 'status',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailPeminjaman(): HasMany
    {
        return $this->hasMany(DetailPeminjaman::class, 'buku_id');
    }

    public function coverUrl(): string
    {
        if ($this->cover) {
            return str_starts_with($this->cover, 'images/')
                ? asset($this->cover)
                : asset('storage/'.$this->cover);
        }

        $defaultCovers = [
            '9786020324784.jpg', '9789793062792.jpg', '9786020385914.jpg',
            '9786024246945.jpg', '9780061120084.jpg', '9780140449136.jpg',
            '9780141439518.jpg', '9780143039433.jpg', '9780451524935.jpg',
            '9780439064873.jpg', '9780060935467.jpg',
        ];

        $cover = $defaultCovers[($this->kategori_id ?? 1) % count($defaultCovers)];

        return asset('images/cover-buku/'.$cover);
    }
}
