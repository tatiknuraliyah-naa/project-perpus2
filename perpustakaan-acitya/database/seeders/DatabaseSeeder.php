<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Urutan seeding wajib mengikuti dependensi foreign key:
     * data master (Petugas, Anggota, Kategori, Achievement) dahulu,
     * baru kemudian data transaksi (dibuat lewat Factory saat diperlukan).
     */
    public function run(): void
    {
        $this->call([
            PetugasSeeder::class,
            AnggotaSeeder::class,
            KategoriSeeder::class,
            BukuSeeder::class,
            AchievementSeeder::class,
        ]);
    }
}
