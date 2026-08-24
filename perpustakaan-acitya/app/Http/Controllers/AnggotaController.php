<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Models\Anggota;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('cari')->trim()->value();
        $role = $request->string('role')->value();
        $status = $request->string('status')->value();

        $anggota = Anggota::query()
            ->withCount(['peminjaman', 'kunjungan'])
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('nis_nisn', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%");
            }))
            ->when(in_array($role, ['Siswa', 'Guru', 'Karyawan'], true), fn ($query) => $query->where('role', $role))
            ->when(in_array($status, ['Aktif', 'Alumni', 'Nonaktif'], true), fn ($query) => $query->where('status', $status))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota', 'search', 'role', 'status'));
    }

    public function create(): View
    {
        return view('anggota.form', ['anggota' => new Anggota]);
    }

    public function store(StoreAnggotaRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('foto');
        $data['foto'] = $request->file('foto')?->store('foto-anggota', 'public');
        Anggota::create($data);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota): View
    {
        return view('anggota.form', compact('anggota'));
    }

    public function update(UpdateAnggotaRequest $request, Anggota $anggota): RedirectResponse
    {
        $data = $request->safe()->except(['foto', 'password']);

        if ($request->filled('password')) {
            $data['password'] = $request->input('password');
        }

        if ($request->hasFile('foto')) {
            if ($anggota->foto) {
                Storage::disk('public')->delete($anggota->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-anggota', 'public');
        }

        $anggota->update($data);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota): RedirectResponse
    {
        if ($anggota->peminjaman()->exists() || $anggota->kunjungan()->exists()) {
            return back()->with('error', 'Anggota dengan riwayat kunjungan atau peminjaman tidak dapat dihapus. Ubah statusnya menjadi Alumni atau Nonaktif.');
        }

        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
