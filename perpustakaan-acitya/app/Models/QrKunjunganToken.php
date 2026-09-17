<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrKunjunganToken extends Model
{
    use HasFactory;
    protected $fillable = ['petugas_id', 'token', 'jam_mulai', 'jam_selesai', 'start_at', 'berlaku_sampai', 'aktif'];
    protected $casts = ['start_at' => 'datetime', 'berlaku_sampai' => 'datetime', 'aktif' => 'boolean'];
    public function petugas(): BelongsTo { return $this->belongsTo(Petugas::class); }
    public function belumAktif(): bool { return now()->lt($this->waktuMulai()); }
    public function sudahKedaluwarsa(): bool { return now()->gt($this->waktuSelesai()); }
    public function masihBerlaku(): bool { return $this->aktif && ! $this->belumAktif() && ! $this->sudahKedaluwarsa(); }

    private function waktuMulai()
    {
        if ($this->jam_mulai !== null) {
            return ($this->created_at ?? now())->copy()->setTimeFromTimeString($this->jam_mulai);
        }

        return $this->start_at ?? $this->created_at ?? now();
    }

    private function waktuSelesai()
    {
        if ($this->jam_selesai !== null) {
            return ($this->created_at ?? now())->copy()->setTimeFromTimeString($this->jam_selesai);
        }

        return $this->berlaku_sampai ?? now();
    }
}
