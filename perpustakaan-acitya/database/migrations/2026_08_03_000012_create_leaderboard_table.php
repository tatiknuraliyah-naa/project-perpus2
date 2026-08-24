<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->cascadeOnDelete();
            $table->enum('periode', ['Bulanan', 'Semester', 'Tahunan']);
            $table->year('tahun');
            $table->unsignedTinyInteger('bulan')->default(0)->comment('0 = tidak berlaku, khusus periode Bulanan diisi 1-12');
            $table->unsignedInteger('total_poin')->default(0);
            $table->unsignedInteger('peringkat')->nullable();
            $table->timestamps();

            $table->unique(['anggota_id', 'periode', 'tahun', 'bulan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaderboard');
    }
};
