<?php

namespace App\Http\Requests;

use App\Models\Peminjaman;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Validator;

class ConfirmPeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth('petugas')->check();
    }

    public function rules(): array
    {
        return [
            'tanggal_pinjam' => ['required', 'date'],
            'tanggal_jatuh_tempo' => ['required', 'date', 'after_or_equal:tanggal_pinjam'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            /** @var Peminjaman $peminjaman */
            $peminjaman = $this->route('peminjaman');

            if ($peminjaman->jenis_peminjaman !== 'Umum' || $validator->errors()->has('tanggal_pinjam')) {
                return;
            }

            $tanggalPinjam = Carbon::parse($this->input('tanggal_pinjam'));
            $tanggalJatuhTempo = Carbon::parse($this->input('tanggal_jatuh_tempo'));

            if (! $tanggalJatuhTempo->isSameDay($tanggalPinjam->copy()->addDays(7))) {
                $validator->errors()->add('tanggal_jatuh_tempo', 'Buku umum harus memiliki masa peminjaman tepat 7 hari.');
            }
        });
    }
}
