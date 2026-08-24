<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AnggotaSeeder extends Seeder
{
    /**
     * Membuat akun contoh untuk role Guru, Karyawan, dan Siswa
     * sesuai permintaan seeder (Guru, Karyawan, Siswa).
     */
    public function run(): void
    {
        Anggota::updateOrCreate(
            ['nip' => '197712102005011003'],
            [
                'role' => 'Guru',
                'nama' => 'Budi Santoso, S.Pd.',
                'jabatan' => 'Guru Produktif RPL',
                'email' => 'budi.santoso@aciytawiguna.sch.id',
                'no_hp' => '081300000001',
                'password' => Hash::make('password'),
                'status' => 'Aktif',
            ]
        );

        Anggota::updateOrCreate(
            ['nip' => '198203152009021004'],
            [
                'role' => 'Karyawan',
                'nama' => 'Rahmat Hidayat',
                'jabatan' => 'Staf Tata Usaha',
                'email' => 'rahmat.hidayat@aciytawiguna.sch.id',
                'no_hp' => '081300000002',
                'password' => Hash::make('password'),
                'status' => 'Aktif',
            ]
        );

        Anggota::updateOrCreate(
            ['nis_nisn' => '0051234567'],
            [
                'role' => 'Siswa',
                'nama' => 'Ayu Lestari',
                'kelas' => 'XI',
                'jurusan' => 'Rekayasa Perangkat Lunak',
                'email' => 'ayu.lestari@siswa.aciytawiguna.sch.id',
                'no_hp' => '081300000003',
                'password' => Hash::make('password'),
                'status' => 'Aktif',
            ]
        );

        Anggota::updateOrCreate(
            ['nis_nisn' => '0051234568'],
            [
                'role' => 'Siswa',
                'nama' => 'Dimas Prasetyo',
                'kelas' => 'XII',
                'jurusan' => 'Teknik Komputer dan Jaringan',
                'email' => 'dimas.prasetyo@siswa.aciytawiguna.sch.id',
                'no_hp' => '081300000004',
                'password' => Hash::make('password'),
                'status' => 'Aktif',
            ]
        );

        // Contoh anggota berstatus Alumni — tidak bisa meminjam baru, riwayat tetap tersimpan.
        Anggota::updateOrCreate(
            ['nis_nisn' => '0049876543'],
            [
                'role' => 'Siswa',
                'nama' => 'Fajar Nugroho',
                'kelas' => 'XII',
                'jurusan' => 'Akuntansi',
                'email' => 'fajar.nugroho@alumni.aciytawiguna.sch.id',
                'no_hp' => '081300000005',
                'password' => Hash::make('password'),
                'status' => 'Alumni',
            ]
        );
    }
}
