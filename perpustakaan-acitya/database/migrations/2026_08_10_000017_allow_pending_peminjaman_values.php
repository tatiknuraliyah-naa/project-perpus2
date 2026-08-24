<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('petugas_id')->nullable()->change();
            $table->date('tanggal_pinjam')->nullable()->change();
            $table->date('tanggal_jatuh_tempo')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('petugas_id')->nullable(false)->change();
            $table->date('tanggal_pinjam')->nullable(false)->change();
            $table->date('tanggal_jatuh_tempo')->nullable(false)->change();
        });
    }
};
