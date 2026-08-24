<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAnggotaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nis_nisn' => $this->filled('nis_nisn') ? $this->input('nis_nisn') : null,
            'nip' => $this->filled('nip') ? $this->input('nip') : null,
            'email' => $this->filled('email') ? $this->input('email') : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'role' => ['required', Rule::in(['Siswa', 'Guru', 'Karyawan'])],
            'nama' => ['required', 'string', 'max:150'],
            'nis_nisn' => [Rule::requiredIf($this->input('role') === 'Siswa'), 'nullable', 'string', 'max:30', Rule::unique('anggota', 'nis_nisn')],
            'nip' => [Rule::requiredIf(in_array($this->input('role'), ['Guru', 'Karyawan'], true)), 'nullable', 'string', 'max:30', Rule::unique('anggota', 'nip')],
            'kelas' => ['nullable', 'string', 'max:20'],
            'jurusan' => ['nullable', 'string', 'max:100'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150', Rule::unique('anggota', 'email')],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['required', Rule::in(['Aktif', 'Alumni', 'Nonaktif'])],
        ];
    }
}
