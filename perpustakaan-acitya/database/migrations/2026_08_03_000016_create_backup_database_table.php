<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_database', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->nullOnDelete();
            $table->string('nama_file', 255);
            $table->unsignedBigInteger('ukuran_file')->nullable()->comment('ukuran dalam bytes');
            $table->enum('status', ['Berhasil', 'Gagal']);
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_database');
    }
};
