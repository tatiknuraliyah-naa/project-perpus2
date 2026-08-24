<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Daftar achievement awal untuk mendukung fitur gamifikasi
     * (PRD §1.4 poin 8 — Achievement & Leaderboard).
     */
    public function run(): void
    {
        $achievements = [
            [
                'nama' => 'Kutu Buku Pemula',
                'deskripsi' => 'Diberikan kepada anggota yang menyelesaikan peminjaman buku pertama.',
                'syarat' => 'Menyelesaikan 1 transaksi peminjaman',
                'icon' => 'achievement/kutu-buku-pemula.png',
            ],
            [
                'nama' => 'Pengunjung Setia',
                'deskripsi' => 'Diberikan kepada anggota yang rutin berkunjung ke perpustakaan.',
                'syarat' => 'Tercatat 10 kali kunjungan',
                'icon' => 'achievement/pengunjung-setia.png',
            ],
            [
                'nama' => 'Kolektor Bacaan',
                'deskripsi' => 'Diberikan kepada anggota yang telah meminjam banyak buku.',
                'syarat' => 'Menyelesaikan 25 transaksi peminjaman',
                'icon' => 'achievement/kolektor-bacaan.png',
            ],
            [
                'nama' => 'Tepat Waktu',
                'deskripsi' => 'Diberikan kepada anggota yang selalu mengembalikan buku sebelum jatuh tempo.',
                'syarat' => '10 pengembalian berturut-turut tanpa keterlambatan',
                'icon' => 'achievement/tepat-waktu.png',
            ],
            [
                'nama' => 'Juara Literasi',
                'deskripsi' => 'Diberikan kepada anggota dengan peringkat 1 leaderboard bulanan.',
                'syarat' => 'Menduduki peringkat 1 pada leaderboard periode Bulanan',
                'icon' => 'achievement/juara-literasi.png',
            ],
        ];

        foreach ($achievements as $item) {
            Achievement::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
