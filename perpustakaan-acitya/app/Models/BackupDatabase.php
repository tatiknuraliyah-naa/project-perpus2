<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BackupDatabase extends Model
{
    use HasFactory;

    protected $table = 'backup_database';

    public const UPDATED_AT = null;

    protected $fillable = ['petugas_id', 'nama_file', 'ukuran_file', 'status', 'keterangan'];

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }
}
