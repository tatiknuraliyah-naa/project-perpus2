<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TemplateAnggotaExport implements FromArray, WithColumnFormatting
{
    public function array(): array
    {
        return [
            ['nama', 'role', 'nis_nisn', 'nip', 'kelas', 'jurusan', 'jabatan', 'email', 'no_hp'],
            ['Andi Pratama', 'Siswa', '123456789', '', 'XII', 'RPL', '', 'andi@example.com', '08123456789'],
            ['Budi Santoso', 'Guru', '', '1987654321', '', '', 'Guru Informatika', 'budi@example.com', '08123456780'],
            ['Siti Aminah', 'Karyawan', '', '1234567890', '', '', 'Pustakawan', 'siti@example.com', '08123456781'],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
