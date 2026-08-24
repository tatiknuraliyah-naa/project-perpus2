<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['Siswa', 'Guru', 'Karyawan'])->index();
            $table->string('nama', 150);
            $table->string('nis_nisn', 30)->nullable()->unique();
            $table->string('nip', 30)->nullable()->unique();
            $table->string('kelas', 20)->nullable();
            $table->string('jurusan', 100)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('email', 150)->nullable()->unique();
            $table->string('no_hp', 20)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('password', 255);
            $table->enum('status', ['Aktif', 'Alumni', 'Nonaktif'])->default('Aktif')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
