<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique();
            $table->string('nama', 150);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('email', 150)->nullable()->unique();
            $table->string('no_hp', 20)->nullable();
            $table->string('foto', 255)->nullable();
            $table->enum('level', ['Admin', 'Petugas'])->default('Petugas');
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};
