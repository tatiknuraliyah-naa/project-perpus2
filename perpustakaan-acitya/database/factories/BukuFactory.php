<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

class BukuFactory extends Factory
{
    protected $model = \App\Models\Buku::class;

    public function definition(): array
    {
        $stok = $this->faker->numberBetween(1, 10);

        return [
            'kategori_id' => Kategori::inRandomOrder()->value('id') ?? Kategori::factory(),
            'kode_buku' => 'BK-' . $this->faker->unique()->numerify('######'),
            'isbn' => $this->faker->unique()->isbn13(),
            'judul' => ucfirst($this->faker->words(4, true)),
            'penulis' => $this->faker->name(),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),
            'lokasi_rak' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
            'jenis_buku' => $this->faker->randomElement(['Umum', 'Umum', 'Umum', 'Paket']),
            'stok' => $stok,
            'stok_tersedia' => $stok,
            'cover' => null,
            'deskripsi' => $this->faker->paragraph(),
            'status' => 'Tersedia',
        ];
    }

    public function paket(): static
    {
        return $this->state(fn () => ['jenis_buku' => 'Paket']);
    }
}
