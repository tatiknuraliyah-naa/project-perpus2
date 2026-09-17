<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('qr_kunjungan_tokens', function (Blueprint $table) {
            $table->timestamp('start_at')->nullable()->after('token')->index();
        });

        DB::table('qr_kunjungan_tokens')
            ->whereNull('start_at')
            ->update(['start_at' => DB::raw('created_at')]);
    }

    public function down(): void
    {
        Schema::table('qr_kunjungan_tokens', function (Blueprint $table) {
            $table->dropIndex(['start_at']);
            $table->dropColumn('start_at');
        });
    }
};
