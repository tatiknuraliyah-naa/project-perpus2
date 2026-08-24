<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreBukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        return [
            'kategori_id' => ['required', 'integer', Rule::exists('kategori', 'id')->whereNull('deleted_at')],
            'kode_buku' => ['required', 'string', 'max:30', Rule::unique('buku', 'kode_buku')],
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('buku', 'isbn')],
            'judul' => ['required', 'string', 'max:255'],
            'penulis' => ['nullable', 'string', 'max:150'],
            'penerbit' => ['nullable', 'string', 'max:150'],
            'tahun_terbit' => ['nullable', 'integer', 'min:1000', 'max:'.date('Y')],
            'lokasi_rak' => ['nullable', 'string', 'max:50'],
            'jenis_buku' => ['required', Rule::in(['Umum', 'Paket'])],
            'stok' => ['required', 'integer', 'min:0'],
            'stok_tersedia' => ['required', 'integer', 'min:0'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['Tersedia', 'Tidak Aktif'])],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ((int) $this->input('stok_tersedia', 0) > (int) $this->input('stok', 0)) {
                $validator->errors()->add('stok_tersedia', 'Stok tersedia tidak boleh melebihi stok total.');
            }
        });
    }
}
