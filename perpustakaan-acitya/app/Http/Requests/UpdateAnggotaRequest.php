<?php

namespace App\Http\Requests;

use App\Models\Anggota;
use Illuminate\Validation\Rule;

class UpdateAnggotaRequest extends StoreAnggotaRequest
{
    public function rules(): array
    {
        /** @var Anggota $anggota */
        $anggota = $this->route('anggota');
        $rules = parent::rules();
        $rules['nis_nisn'] = [Rule::requiredIf($this->input('role') === 'Siswa'), 'nullable', 'string', 'max:30', Rule::unique('anggota', 'nis_nisn')->ignore($anggota)];
        $rules['nip'] = [Rule::requiredIf(in_array($this->input('role'), ['Guru', 'Karyawan'], true)), 'nullable', 'string', 'max:30', Rule::unique('anggota', 'nip')->ignore($anggota)];
        $rules['email'] = ['nullable', 'email', 'max:150', Rule::unique('anggota', 'email')->ignore($anggota)];
        $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed'];

        return $rules;
    }
}
