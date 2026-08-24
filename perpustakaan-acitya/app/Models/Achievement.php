<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'achievement';

    protected $fillable = ['nama', 'deskripsi', 'syarat', 'icon'];

    public function achievementPengguna(): HasMany
    {
        return $this->hasMany(AchievementPengguna::class, 'achievement_id');
    }

    public function anggota(): BelongsToMany
    {
        return $this->belongsToMany(Anggota::class, 'achievement_pengguna', 'achievement_id', 'anggota_id')
            ->withPivot('tanggal_didapat')
            ->withTimestamps();
    }
}
