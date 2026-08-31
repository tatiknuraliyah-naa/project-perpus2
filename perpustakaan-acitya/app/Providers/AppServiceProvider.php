<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $temporaryPath = storage_path('framework/laravel-excel-temp');

        // Jalur ini dimiliki Laravel dan akan dibuat oleh user proses PHP/Apache saat belum ada.
        if (! File::isDirectory($temporaryPath) && is_writable(dirname($temporaryPath))) {
            File::ensureDirectoryExists($temporaryPath, 0775, true);
        }

        // Pastikan user proses PHP dan group runtime dapat membuat file sementara.
        if (File::isDirectory($temporaryPath)) {
            @chmod($temporaryPath, 0775);
        }

        config()->set('excel.temporary_files.local_path', $temporaryPath);
        config()->set('excel.temporary_files.remote_disk', null);

        // Didaftarkan eksplisit agar tetap tersedia saat cache package belum dapat dibangun ulang.
        $this->app->register(\Maatwebsite\Excel\ExcelServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination.default');
        Paginator::defaultSimpleView('pagination.simple');
    }
}
