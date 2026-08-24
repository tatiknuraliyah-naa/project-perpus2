<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Petugas;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeminjamanFactory extends Factory
{
    protected $model = \App\Models\Peminjaman::class;

    public function definition(): array
    {
        $tanggalPinjam = $this->faker->dateTimeBetween('-2 months', 'now');

        return [
            'anggota_id' => Anggota::inRandomOrder()->value('id') ?? Anggota::factory(),
            'petugas_id' => Petugas::inRandomOrder()->value('id') ?? Petugas::factory(),
            'tanggal_pinjam' => $tanggalPinjam->format('Y-m-d'),
            // Aturan PRD §2.7: lama pinjam buku umum 7 hari.
            'tanggal_jatuh_tempo' => (clone $tanggalPinjam)->modify('+7 days')->format('Y-m-d'),
            'jenis_peminjaman' => 'Umum',
            'status' => $this->faker->randomElement(['Menunggu', 'Dipinjam', 'Dikembalikan', 'Terlambat']),
        ];
    }
}
