<?php

namespace App\Console\Commands;

use App\Support\DatabaseBackup;
use Illuminate\Console\Command;

class BackupDatabaseCommand extends Command
{
    protected $signature = 'backup:database {--petugas-id=}';

    protected $description = 'Membuat backup MySQL AcityaLib tanpa mengubah data utama.';

    public function handle(DatabaseBackup $backup): int
    {
        $record = $backup->create(
            $this->option('petugas-id') ? (int) $this->option('petugas-id') : null,
        );

        if ($record->status === 'Gagal') {
            $this->error('Backup gagal: ' . $record->keterangan);

            return self::FAILURE;
        }

        $this->info('Backup berhasil dibuat: ' . $record->nama_file);

        return self::SUCCESS;
    }
}
