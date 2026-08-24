<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggantian_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengembalian_id')->unique()->constrained('pengembalian')->cascadeOnDelete();
            $table->string('buku_hilang', 255);
            $table->string('buku_pengganti', 255)->nullable();
            $table->date('tanggal_lapor');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['Menunggu', 'Diverifikasi', 'Selesai'])->default('Menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggantian_buku');
    }
};
