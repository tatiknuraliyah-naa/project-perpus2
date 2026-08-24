<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrKunjunganToken extends Model
{
    use HasFactory;
    protected $fillable = ['petugas_id', 'token', 'berlaku_sampai', 'aktif'];
    protected $casts = ['berlaku_sampai' => 'datetime', 'aktif' => 'boolean'];
    public function petugas(): BelongsTo { return $this->belongsTo(Petugas::class); }
    public function masihBerlaku(): bool { return $this->aktif && $this->berlaku_sampai->isFuture(); }
}
