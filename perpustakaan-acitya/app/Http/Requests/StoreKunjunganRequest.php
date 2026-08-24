<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKunjunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('anggota')->check();
    }

    public function rules(): array
    {
        return [
            'tujuan' => ['required', Rule::in(['Membaca', 'Meminjam', 'Mengembalikan', 'Belajar', 'Referensi', 'Lainnya'])],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
