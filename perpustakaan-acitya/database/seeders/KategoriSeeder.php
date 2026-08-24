<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * 10 kategori dasar berdasarkan Dewey Decimal Classification (DDC)
     * sesuai tabel "Kategori DDC" pada PRD §4.2.C.
     */
    public function run(): void
    {
        $kategori = [
            ['kode_ddc' => '000', 'nama_kategori' => 'Karya Umum'],
            ['kode_ddc' => '100', 'nama_kategori' => 'Filsafat & Psikologi'],
            ['kode_ddc' => '200', 'nama_kategori' => 'Agama'],
            ['kode_ddc' => '300', 'nama_kategori' => 'Ilmu Sosial'],
            ['kode_ddc' => '400', 'nama_kategori' => 'Bahasa'],
            ['kode_ddc' => '500', 'nama_kategori' => 'Ilmu Murni'],
            ['kode_ddc' => '600', 'nama_kategori' => 'Ilmu Terapan & Teknologi'],
            ['kode_ddc' => '700', 'nama_kategori' => 'Seni & Rekreasi'],
            ['kode_ddc' => '800', 'nama_kategori' => 'Kesusastraan'],
            ['kode_ddc' => '900', 'nama_kategori' => 'Sejarah & Geografi'],
        ];

        foreach ($kategori as $item) {
            Kategori::updateOrCreate(['kode_ddc' => $item['kode_ddc']], $item);
        }
    }
}
