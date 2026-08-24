<?php

namespace App\Http\Requests;

use App\Models\Kategori;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        /** @var Kategori $kategori */
        $kategori = $this->route('kategori');

        return [
            'kode_ddc' => ['required', 'string', 'max:10', Rule::unique('kategori', 'kode_ddc')->ignore($kategori)],
            'nama_kategori' => ['required', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
        ];
    }
}
