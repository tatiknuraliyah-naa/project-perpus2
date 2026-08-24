<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class PetugasFactory extends Factory
{
    protected $model = \App\Models\Petugas::class;

    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numerify('19#################'),
            'nama' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'),
            'email' => $this->faker->unique()->safeEmail(),
            'no_hp' => $this->faker->numerify('08##########'),
            'foto' => null,
            'level' => 'Petugas',
            'status' => 'Aktif',
        ];
    }
}
