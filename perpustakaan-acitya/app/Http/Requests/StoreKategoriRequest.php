<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        return [
            'kode_ddc' => ['required', 'string', 'max:10', Rule::unique('kategori', 'kode_ddc')],
            'nama_kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }
}
