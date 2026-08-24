<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKunjunganRequest;
use App\Models\Kunjungan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KunjunganController extends Controller
{
    public function index(Request $request): View
    {
        $isPetugas = auth('petugas')->check();
        $search = $request->string('cari')->trim()->value();
        $tanggal = $request->date('tanggal');

        $kunjungan = Kunjungan::query()
            ->with('anggota:id,nama,role,nis_nisn,nip')
            ->when(! $isPetugas, fn ($query) => $query->where('anggota_id', auth('anggota')->id()))
            ->when($isPetugas && $search, fn ($query) => $query->whereHas('anggota', function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis_nisn', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            }))
            ->when($tanggal, fn ($query) => $query->whereDate('tanggal', $tanggal))
            ->latest('tanggal')
            ->latest('jam_masuk')
            ->paginate(12)
            ->withQueryString();

        return view('kunjungan.index', compact('kunjungan', 'isPetugas', 'search', 'tanggal'));
    }

    public function create(): View
    {
        abort_unless(auth('anggota')->check(), 403);

        $sudahMengisi = Kunjungan::query()
            ->where('anggota_id', auth('anggota')->id())
            ->whereDate('tanggal', today())
            ->exists();

        return view('kunjungan.form', compact('sudahMengisi'));
    }

    public function store(StoreKunjunganRequest $request): RedirectResponse
    {
        $anggota = auth('anggota')->user();

        $sudahMengisi = Kunjungan::query()
            ->where('anggota_id', $anggota->id)
            ->whereDate('tanggal', today())
            ->exists();

        if ($sudahMengisi) {
            return redirect()->route('kunjungan.index')->with('error', 'Kunjungan Anda untuk hari ini sudah tercatat.');
        }

        Kunjungan::create([
            ...$request->validated(),
            'anggota_id' => $anggota->id,
            'tanggal' => today(),
            'jam_masuk' => now(),
        ]);

        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil dicatat. Selamat beraktivitas di perpustakaan.');
    }
}
