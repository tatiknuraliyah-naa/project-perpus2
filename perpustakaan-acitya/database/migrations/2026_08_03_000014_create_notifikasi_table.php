<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->cascadeOnDelete();
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->cascadeOnDelete();
            $table->string('judul', 150);
            $table->text('pesan');
            $table->enum('tipe', ['Peminjaman', 'Pengembalian', 'JatuhTempo', 'Pengumuman', 'Achievement', 'Sistem']);
            $table->enum('status_baca', ['Belum Dibaca', 'Sudah Dibaca'])->default('Belum Dibaca');
            $table->string('tautan', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
