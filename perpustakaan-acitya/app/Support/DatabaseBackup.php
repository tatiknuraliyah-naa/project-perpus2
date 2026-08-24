<?php

namespace App\Support;

use App\Models\BackupDatabase;
use Illuminate\Support\Facades\File;
use RuntimeException;

class DatabaseBackup
{
    public function create(?int $petugasId = null): BackupDatabase
    {
        $filename = 'acityalib-' . now()->format('Y-m-d-His') . '.sql';
        $directory = storage_path('app/backups');
        $path = $directory . DIRECTORY_SEPARATOR . $filename;

        try {
            if (config('database.default') !== 'mysql') {
                throw new RuntimeException('Backup otomatis saat ini hanya mendukung koneksi MySQL.');
            }

            File::ensureDirectoryExists($directory, 0750, true);

            $connection = config('database.connections.mysql');
            $command = [
                config('backup.binary', '/usr/bin/mysqldump'),
                '--host=' . $connection['host'],
                '--port=' . $connection['port'],
                '--user=' . $connection['username'],
                '--single-transaction',
                '--quick',
                '--routines',
                '--events',
                '--no-tablespaces',
                $connection['database'],
            ];
            $descriptors = [
                0 => ['pipe', 'r'],
                1 => ['file', $path, 'w'],
                2 => ['pipe', 'w'],
            ];
            $process = proc_open(
                $command,
                $descriptors,
                $pipes,
                base_path(),
                ['MYSQL_PWD' => (string) $connection['password']],
                ['bypass_shell' => true],
            );

            if (! is_resource($process)) {
                throw new RuntimeException('Proses backup database tidak dapat dijalankan.');
            }

            fclose($pipes[0]);
            $errorOutput = stream_get_contents($pipes[2]);
            fclose($pipes[2]);
            $exitCode = proc_close($process);

            if ($exitCode !== 0 || ! File::exists($path) || File::size($path) === 0) {
                File::delete($path);
                throw new RuntimeException(trim($errorOutput) ?: 'mysqldump gagal membuat file backup.');
            }

            return BackupDatabase::create([
                'petugas_id' => $petugasId,
                'nama_file' => $filename,
                'ukuran_file' => File::size($path),
                'status' => 'Berhasil',
                'keterangan' => 'Backup MySQL dibuat secara aman.',
            ]);
        } catch (\Throwable $exception) {
            return BackupDatabase::create([
                'petugas_id' => $petugasId,
                'nama_file' => $filename,
                'status' => 'Gagal',
                'keterangan' => $exception->getMessage(),
            ]);
        }
    }
}
