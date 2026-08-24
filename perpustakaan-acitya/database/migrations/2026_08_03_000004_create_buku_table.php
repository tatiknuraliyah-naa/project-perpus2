<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->string('kode_buku', 30)->unique();
            $table->string('isbn', 20)->nullable()->unique();
            $table->string('judul', 255)->index();
            $table->string('penulis', 150)->nullable()->index();
            $table->string('penerbit', 150)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('lokasi_rak', 50)->nullable();
            $table->enum('jenis_buku', ['Umum', 'Paket'])->default('Umum');
            $table->unsignedInteger('stok')->default(0);
            $table->unsignedInteger('stok_tersedia')->default(0);
            $table->string('cover', 255)->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Tersedia', 'Tidak Aktif'])->default('Tersedia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
