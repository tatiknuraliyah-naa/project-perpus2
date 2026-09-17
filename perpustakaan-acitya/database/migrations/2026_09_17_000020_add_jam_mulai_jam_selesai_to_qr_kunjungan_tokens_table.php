<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_kunjungan_tokens', function (Blueprint $table) {
            $table->time('jam_mulai')->nullable()->after('token')->index();
            $table->time('jam_selesai')->nullable()->after('jam_mulai')->index();
        });
    }

    public function down(): void
    {
        Schema::table('qr_kunjungan_tokens', function (Blueprint $table) {
            $table->dropIndex(['jam_mulai']);
            $table->dropIndex(['jam_selesai']);
            $table->dropColumn(['jam_mulai', 'jam_selesai']);
        });
    }
};
