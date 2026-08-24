<?php

namespace App\Http\Requests;

use App\Models\Buku;
use Illuminate\Validation\Rule;

class UpdateBukuRequest extends StoreBukuRequest
{
    public function rules(): array
    {
        /** @var Buku $buku */
        $buku = $this->route('buku');
        $rules = parent::rules();
        $rules['kode_buku'] = ['required', 'string', 'max:30', Rule::unique('buku', 'kode_buku')->ignore($buku)];
        $rules['isbn'] = ['nullable', 'string', 'max:20', Rule::unique('buku', 'isbn')->ignore($buku)];

        return $rules;
    }
}
