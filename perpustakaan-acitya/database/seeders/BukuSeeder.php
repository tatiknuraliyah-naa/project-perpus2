<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        $koleksi = [
            ['000', 'BK-0001', '9786020324784', 'Bumi', 'Tere Liye', 'Gramedia Pustaka Utama', 2014, 'A1', 'Umum', 6, '9786020324784.jpg'],
            ['100', 'BK-0002', '9789793062792', 'Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 'A2', 'Umum', 4, '9789793062792.jpg'],
            ['200', 'BK-0003', '9786020385914', 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 'Republika', 2004, 'B1', 'Umum', 5, '9786020385914.jpg'],
            ['300', 'BK-0004', '9786024246945', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 2009, 'B2', 'Umum', 5, '9786024246945.jpg'],
            ['400', 'BK-0005', '9780061120084', 'To Kill a Mockingbird', 'Harper Lee', 'Harper Perennial', 2006, 'C1', 'Umum', 3, '9780061120084.jpg'],
            ['500', 'BK-0006', '9780140449136', 'The Odyssey', 'Homer', 'Penguin Classics', 2003, 'C2', 'Umum', 3, '9780140449136.jpg'],
            ['600', 'BK-0007', '9780141439518', 'Pride and Prejudice', 'Jane Austen', 'Penguin Classics', 2003, 'D1', 'Umum', 4, '9780141439518.jpg'],
            ['700', 'BK-0008', '9780143039433', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Penguin Classics', 2004, 'D2', 'Umum', 3, '9780143039433.jpg'],
            ['800', 'BK-0009', '9780451524935', '1984', 'George Orwell', 'Signet Classics', 1950, 'E1', 'Umum', 5, '9780451524935.jpg'],
            ['900', 'BK-0010', '9780439064873', 'Harry Potter dan Batu Bertuah', 'J. K. Rowling', 'Scholastic', 1998, 'E2', 'Umum', 4, '9780439064873.jpg'],
        ];

        foreach ($koleksi as [$kodeDdc, $kodeBuku, $isbn, $judul, $penulis, $penerbit, $tahun, $rak, $jenis, $stok, $cover]) {
            Buku::updateOrCreate(
                ['kode_buku' => $kodeBuku],
                [
                    'kategori_id' => Kategori::where('kode_ddc', $kodeDdc)->value('id'),
                    'isbn' => $isbn,
                    'judul' => $judul,
                    'penulis' => $penulis,
                    'penerbit' => $penerbit,
                    'tahun_terbit' => $tahun,
                    'lokasi_rak' => $rak,
                    'jenis_buku' => $jenis,
                    'stok' => $stok,
                    'stok_tersedia' => $stok,
                    'cover' => 'images/cover-buku/'.$cover,
                    'deskripsi' => 'Koleksi Perpustakaan Acitya Wiguna.',
                    'status' => 'Tersedia',
                ]
            );
        }
    }
}
