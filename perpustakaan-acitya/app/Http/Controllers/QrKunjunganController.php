<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\QrKunjunganToken;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
        $data = $request->validate(['menit_berlaku' => ['required', 'integer', 'min:5', 'max:480']]);
        QrKunjunganToken::query()->where('petugas_id', auth('petugas')->id())->where('aktif', true)->update(['aktif' => false]);
        $token = QrKunjunganToken::create(['petugas_id' => auth('petugas')->id(), 'token' => Str::random(48), 'berlaku_sampai' => now()->addMinutes($data['menit_berlaku'])]);
        ActivityLogger::log('Membuat QR kunjungan baru', 'Kunjungan');
        return redirect()->route('qr-kunjungan.index')->with('success', 'QR kunjungan baru berhasil dibuat.');
    }
    public function scan(QrKunjunganToken $token): View
    {
        abort_unless($token->masihBerlaku(), 410, 'QR Code sudah tidak berlaku.');
        abort_unless(auth('anggota')->check(), 403);
        $sudahMengisi = Kunjungan::where('anggota_id', auth('anggota')->id())->whereDate('tanggal', today())->exists();
        return view('qr-kunjungan.scan', compact('token', 'sudahMengisi'));
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
