<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePengembalianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        return [
            'tanggal_kembali' => ['required', 'date', 'before_or_equal:today'],
            'kondisi' => ['required', Rule::in(['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'])],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
