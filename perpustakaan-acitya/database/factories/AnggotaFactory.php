<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AnggotaFactory extends Factory
{
    protected $model = \App\Models\Anggota::class;

    public function definition(): array
    {
        $role = $this->faker->randomElement(['Siswa', 'Guru', 'Karyawan']);

        return [
            'role' => $role,
            'nama' => $this->faker->name(),
            'nis_nisn' => $role === 'Siswa' ? $this->faker->unique()->numerify('00#########') : null,
            'nip' => $role !== 'Siswa' ? $this->faker->unique()->numerify('19#################') : null,
            'kelas' => $role === 'Siswa' ? $this->faker->randomElement(['X', 'XI', 'XII']) : null,
            'jurusan' => $role === 'Siswa' ? $this->faker->randomElement([
                'Rekayasa Perangkat Lunak', 'Teknik Komputer dan Jaringan', 'Akuntansi', 'Multimedia',
            ]) : null,
            'jabatan' => $role !== 'Siswa' ? $this->faker->randomElement([
                'Guru Mata Pelajaran', 'Wali Kelas', 'Staf Tata Usaha', 'Staf Kurikulum',
            ]) : null,
            'email' => $this->faker->unique()->safeEmail(),
            'no_hp' => $this->faker->numerify('08##########'),
            'foto' => null,
            'password' => Hash::make('password'),
            'status' => $this->faker->randomElement(['Aktif', 'Aktif', 'Aktif', 'Alumni', 'Nonaktif']),
        ];
    }

    public function siswa(): static
    {
        return $this->state(fn () => [
            'role' => 'Siswa',
            'nis_nisn' => $this->faker->unique()->numerify('00#########'),
            'nip' => null,
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'jurusan' => $this->faker->randomElement(['Rekayasa Perangkat Lunak', 'Teknik Komputer dan Jaringan']),
            'jabatan' => null,
        ]);
    }

    public function alumni(): static
    {
        return $this->state(fn () => ['status' => 'Alumni']);
    }
}
