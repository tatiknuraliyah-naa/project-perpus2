<?php

namespace Database\Factories;

use App\Models\Petugas;
use Illuminate\Database\Eloquent\Factories\Factory;

class PengumumanFactory extends Factory
{
    protected $model = \App\Models\Pengumuman::class;

    public function definition(): array
    {
        $tanggalPublish = $this->faker->dateTimeBetween('-1 month', 'now');

        return [
            'petugas_id' => Petugas::inRandomOrder()->value('id') ?? Petugas::factory(),
            'judul' => ucfirst($this->faker->sentence(6)),
            'isi' => $this->faker->paragraphs(2, true),
            'tanggal_publish' => $tanggalPublish->format('Y-m-d'),
            'tanggal_berakhir' => (clone $tanggalPublish)->modify('+30 days')->format('Y-m-d'),
            'status' => 'Aktif',
        ];
    }
}
