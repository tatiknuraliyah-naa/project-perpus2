<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('anggota')->check();
    }

    public function rules(): array
    {
        return [
            'buku_id' => ['required', 'integer', Rule::exists('buku', 'id')->whereNull('deleted_at')],
        ];
    }
}
