<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        $guard = auth('petugas')->check() ? 'petugas' : 'anggota';
        $account = auth($guard)->user();
        $isPetugas = $guard === 'petugas';
        $achievementPengguna = collect();
        $ringkasanAnggota = null;

        if (! $isPetugas) {
            $account->load([
                'achievementPengguna' => fn ($query) => $query
                    ->with('achievement:id,nama,deskripsi,icon')
                    ->latest('tanggal_didapat'),
            ]);

            $achievementPengguna = $account->achievementPengguna
                ->filter(fn ($riwayat) => $riwayat->achievement !== null)
                ->values();
            $leaderboardTerakhir = $account->leaderboard()
                ->latest('updated_at')
                ->first(['total_poin', 'peringkat', 'periode', 'tahun', 'bulan']);

            $ringkasanAnggota = [
                'total_poin' => $leaderboardTerakhir?->total_poin ?? 0,
                'peringkat' => $leaderboardTerakhir?->peringkat,
                'peminjaman' => $account->peminjaman()->count(),
                'kunjungan' => $account->kunjungan()->count(),
            ];
        }

        return view('profile.edit', compact('account', 'isPetugas', 'achievementPengguna', 'ringkasanAnggota'));
    }
    public function update(Request $request): RedirectResponse
    {
        $isPetugas = auth('petugas')->check(); $account = auth($isPetugas ? 'petugas' : 'anggota')->user();
        $rules = ['nama' => ['required', 'string', 'max:150'], 'email' => ['nullable', 'email', 'max:150', Rule::unique($isPetugas ? 'petugas' : 'anggota', 'email')->ignore($account)], 'no_hp' => ['nullable', 'string', 'max:20'], 'password_lama' => ['nullable', 'required_with:password'], 'password' => ['nullable', 'string', 'min:8', 'confirmed']];
        $data = $request->validate($rules);
        if (filled($data['password'] ?? null) && ! Hash::check($data['password_lama'], $account->password)) return back()->withErrors(['password_lama' => 'Password saat ini tidak tepat.']);
        $account->update(collect($data)->only(['nama', 'email', 'no_hp', 'password'])->filter(fn ($value) => $value !== null)->all());
        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
