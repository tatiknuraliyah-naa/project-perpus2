<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_kunjungan_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petugas_id')->constrained('petugas')->restrictOnDelete();
            $table->string('token', 64)->unique();
            $table->timestamp('berlaku_sampai')->index();
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('qr_kunjungan_tokens'); }
};
