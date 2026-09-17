<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\QrKunjunganToken;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class QrKunjunganController extends Controller
{
    /** Menampilkan pemindai kamera untuk anggota. */
    public function camera(): View
    {
        abort_unless(auth('anggota')->check(), 403);

        return view('qr-kunjungan.camera');
    }

    public function index(): View
    {
        $token = QrKunjunganToken::query()->where('petugas_id', auth('petugas')->id())->latest()->first();
        return view('qr-kunjungan.index', compact('token'));
    }
    public function generate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => [
                'required',
                'date_format:H:i',
                function (string $attribute, mixed $value, \Closure $fail) use ($request): void {
                    $jamMulai = $request->input('jam_mulai');

                    if (! is_string($jamMulai) || ! preg_match('/^\d{2}:\d{2}$/', $jamMulai) || ! is_string($value) || ! preg_match('/^\d{2}:\d{2}$/', $value)) {
                        return;
                    }

                    [$mulaiJam, $mulaiMenit] = array_map('intval', explode(':', $jamMulai));
                    [$selesaiJam, $selesaiMenit] = array_map('intval', explode(':', $value));

                    if ($mulaiJam > 23 || $mulaiMenit > 59 || $selesaiJam > 23 || $selesaiMenit > 59) {
                        return;
                    }

                    if (($selesaiJam * 60 + $selesaiMenit) <= ($mulaiJam * 60 + $mulaiMenit)) {
                        $fail('Jam selesai harus lebih besar daripada jam mulai.');
                    }
                },
            ],
        ], [
            'jam_mulai.required' => 'Jam mulai wajib diisi.',
            'jam_mulai.date_format' => 'Format jam mulai harus HH:MM.',
            'jam_selesai.required' => 'Jam selesai wajib diisi.',
            'jam_selesai.date_format' => 'Format jam selesai harus HH:MM.',
        ]);

        $tanggal = now();
        $mulai = $tanggal->copy()->setTimeFromTimeString($data['jam_mulai']);
        $selesai = $tanggal->copy()->setTimeFromTimeString($data['jam_selesai']);

        QrKunjunganToken::query()->where('petugas_id', auth('petugas')->id())->where('aktif', true)->update(['aktif' => false]);
        $token = QrKunjunganToken::create(['petugas_id' => auth('petugas')->id(), 'token' => Str::random(48), 'jam_mulai' => $data['jam_mulai'], 'jam_selesai' => $data['jam_selesai'], 'start_at' => $mulai, 'berlaku_sampai' => $selesai]);
        ActivityLogger::log('Membuat QR kunjungan baru', 'Kunjungan');
        return redirect()->route('qr-kunjungan.index')->with('success', 'QR kunjungan baru berhasil dibuat.');
    }
    public function scan(string $token): RedirectResponse|Response
    {
        $qrToken = QrKunjunganToken::query()->where('token', $token)->first();

        if ($qrToken === null) {
            return response()->view('qr-kunjungan.status', [
                'title' => 'QR Tidak Valid',
                'message' => 'QR Code tidak valid atau sudah tidak tersedia.',
            ], 404);
        }

        if ($qrToken->belumAktif()) {
            return response()->view('qr-kunjungan.status', [
                'title' => 'QR Belum Aktif',
                'message' => 'QR Code ini belum dapat digunakan. Silakan tunggu sampai waktu aktifnya.',
            ], 409);
        }

        if (! $qrToken->masihBerlaku()) {
            return response()->view('qr-kunjungan.status', [
                'title' => 'QR Kedaluwarsa',
                'message' => 'Masa berlaku QR Code ini telah berakhir. Silakan minta QR Code baru kepada petugas.',
            ], 410);
        }

        return redirect()->route('landing');
    }
    public function record(Request $request, QrKunjunganToken $token): RedirectResponse
    {
        abort_unless($token->masihBerlaku(), 410, 'QR Code sudah tidak berlaku.');
        abort_unless(auth('anggota')->check(), 403);
        $data = $request->validate(['tujuan' => ['required', 'in:Membaca,Meminjam,Mengembalikan,Belajar,Referensi,Lainnya'], 'catatan' => ['nullable', 'string', 'max:1000']]);
        $kunjungan = Kunjungan::firstOrCreate(['anggota_id' => auth('anggota')->id(), 'tanggal' => today()], [...$data, 'jam_masuk' => now()]);
        return redirect()->route('kunjungan.index')->with($kunjungan->wasRecentlyCreated ? 'success' : 'error', $kunjungan->wasRecentlyCreated ? 'Kunjungan dari QR berhasil dicatat.' : 'Kunjungan Anda hari ini sudah tercatat.');
    }
}
