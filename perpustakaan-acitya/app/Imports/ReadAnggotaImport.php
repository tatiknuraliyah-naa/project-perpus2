<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ReadAnggotaImport implements ToCollection
{
    public function collection(Collection $collection): void
    {
        // Pembacaan dilakukan oleh controller agar kesalahan dapat dilaporkan per baris.
    }
}
