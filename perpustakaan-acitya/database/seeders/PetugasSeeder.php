<?php

namespace Database\Seeders;

use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    /**
     * Membuat akun Admin dan Petugas.
     * PRD: "petugas hanya berjumlah satu orang" saat ini,
     * namun skema dibuat scalable untuk menampung level Admin terpisah.
     */
    public function run(): void
    {
        Petugas::updateOrCreate(
            ['username' => 'admin'],
            [
                'nip' => '198001012010011001',
                'nama' => 'Administrator Sistem',
                'password' => Hash::make('password'),
                'email' => 'admin@aciytawiguna.sch.id',
                'no_hp' => '081200000001',
                'level' => 'Admin',
                'status' => 'Aktif',
            ]
        );

        Petugas::updateOrCreate(
            ['username' => 'petugas1'],
            [
                'nip' => '198505052012012002',
                'nama' => 'Sri Wahyuni',
                'password' => Hash::make('password'),
                'email' => 'petugas@aciytawiguna.sch.id',
                'no_hp' => '081200000002',
                'level' => 'Petugas',
                'status' => 'Aktif',
            ]
        );
    }
}
