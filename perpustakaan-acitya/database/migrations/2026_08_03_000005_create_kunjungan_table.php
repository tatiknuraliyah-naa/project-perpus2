<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->restrictOnDelete();
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->enum('tujuan', ['Membaca', 'Meminjam', 'Mengembalikan', 'Belajar', 'Referensi', 'Lainnya']);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->index(['anggota_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
