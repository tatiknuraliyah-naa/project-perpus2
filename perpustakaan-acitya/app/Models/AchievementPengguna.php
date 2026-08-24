<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AchievementPengguna extends Model
{
    use HasFactory;

    protected $table = 'achievement_pengguna';

    protected $fillable = ['anggota_id', 'achievement_id', 'tanggal_didapat'];

    protected $casts = ['tanggal_didapat' => 'date'];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class, 'achievement_id');
    }
}
