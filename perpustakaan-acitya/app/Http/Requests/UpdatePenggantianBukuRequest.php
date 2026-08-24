<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdatePenggantianBukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        return [
            'buku_pengganti' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(['Menunggu', 'Diverifikasi', 'Selesai'])],
            'catatan' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->input('status') === 'Selesai' && blank($this->input('buku_pengganti'))) {
                $validator->errors()->add('buku_pengganti', 'Judul buku pengganti wajib diisi sebelum penggantian diselesaikan.');
            }
        });
    }
}
