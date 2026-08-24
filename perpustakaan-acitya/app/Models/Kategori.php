<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';

    protected $fillable = ['kode_ddc', 'nama_kategori', 'deskripsi'];

    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'kategori_id');
    }
}
