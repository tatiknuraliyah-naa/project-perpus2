<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

class KunjunganFactory extends Factory
{
    protected $model = \App\Models\Kunjungan::class;

    public function definition(): array
    {
        return [
            'anggota_id' => Anggota::inRandomOrder()->value('id') ?? Anggota::factory(),
            'tanggal' => $this->faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'jam_masuk' => $this->faker->time('H:i:s'),
            'tujuan' => $this->faker->randomElement([
                'Membaca', 'Meminjam', 'Mengembalikan', 'Belajar', 'Referensi', 'Lainnya',
            ]),
            'catatan' => $this->faker->optional()->sentence(),
        ];
    }
}
