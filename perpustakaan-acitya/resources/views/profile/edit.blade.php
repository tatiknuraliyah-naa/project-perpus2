@extends('layouts.app')

@section('content')
    <main class="app-page profile-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Akun</p>
                <h1>Profil Saya</h1>
                <p class="muted">Kelola data akun dan pantau perkembangan literasi Anda.</p>
            </div>
        </header>

        @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        @if (! $isPetugas)
            <section class="profile-overview" aria-label="Ringkasan aktivitas">
                <article class="profile-identity">
                    <span class="profile-avatar profile-avatar-large">{{ strtoupper(mb_substr($account->nama, 0, 1)) }}</span>
                    <div><p class="eyebrow">{{ $account->role }}</p><h2>{{ $account->nama }}</h2><p class="muted">{{ $account->role === 'Siswa' ? trim(($account->kelas ?? '').' '.($account->jurusan ?? '')) : ($account->jabatan ?: 'Anggota perpustakaan') }}</p></div>
                </article>
                <div class="profile-stat-grid">
                    <article class="profile-stat"><span>Total poin</span><strong>{{ number_format($ringkasanAnggota['total_poin'], 0, ',', '.') }}</strong></article>
                    <article class="profile-stat"><span>Peringkat terakhir</span><strong>{{ $ringkasanAnggota['peringkat'] ? '#'.$ringkasanAnggota['peringkat'] : '—' }}</strong></article>
                    <article class="profile-stat"><span>Peminjaman</span><strong>{{ $ringkasanAnggota['peminjaman'] }}</strong></article>
                    <article class="profile-stat"><span>Kunjungan</span><strong>{{ $ringkasanAnggota['kunjungan'] }}</strong></article>
                </div>
            </section>

            <section class="achievement-section" aria-labelledby="achievement-title">
                <div class="dashboard-section-heading">
                    <div><p class="eyebrow">Pencapaian</p><h2 id="achievement-title">Achievement Saya</h2><p class="muted">Pencapaian yang berhasil Anda peroleh dari aktivitas literasi.</p></div>
                    <a class="text-link" href="{{ route('leaderboard.index') }}">Lihat leaderboard</a>
                </div>
                @if ($achievementPengguna->isNotEmpty())
                    <div class="achievement-grid">
                        @foreach ($achievementPengguna as $riwayat)
                            @php
                                $achievement = $riwayat->achievement;
                                $publicIcon = $achievement?->icon && file_exists(public_path($achievement->icon));
                                $storageIcon = $achievement?->icon && file_exists(public_path('storage/'.$achievement->icon));
                            @endphp
                            @if ($achievement)
                                <article class="achievement-card">
                                    <div class="achievement-icon" aria-hidden="true">
                                        @if ($publicIcon)<img src="{{ asset($achievement->icon) }}" alt="">
                                        @elseif ($storageIcon)<img src="{{ asset('storage/'.$achievement->icon) }}" alt="">
                                        @else<span>🏆</span>@endif
                                    </div>
                                    <div><h3>{{ $achievement->nama }}</h3><p>{{ $achievement->deskripsi ?: $achievement->syarat }}</p><small>Diperoleh {{ $riwayat->tanggal_didapat?->translatedFormat('d M Y') }}</small></div>
                                </article>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="achievement-empty"><span aria-hidden="true">✦</span><div><strong>Belum ada achievement yang diperoleh</strong><p>Terus membaca, berkunjung, dan selesaikan peminjaman untuk membuka pencapaian baru.</p></div></div>
                @endif
            </section>
        @endif

        <section class="content-card form-card profile-form-card">
            <div class="form-card-heading"><div><p class="eyebrow">Pengaturan akun</p><h2>Data profil</h2></div></div>
            <form class="form-stack" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div><label for="nama">Nama</label><input id="nama" name="nama" value="{{ old('nama', $account->nama) }}" required>@error('nama')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email', $account->email) }}">@error('email')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div><label for="no_hp">No. HP</label><input id="no_hp" name="no_hp" value="{{ old('no_hp', $account->no_hp) }}">@error('no_hp')<p class="field-error">{{ $message }}</p>@enderror</div>
                </div>
                <div class="form-divider"><h2>Ubah password <span>(opsional)</span></h2><p class="muted">Kosongkan bila Anda tidak ingin mengganti password.</p></div>
                <div class="form-grid">
                    <div><label for="password_lama">Password saat ini</label><input id="password_lama" name="password_lama" type="password">@error('password_lama')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div><label for="password">Password baru</label><input id="password" name="password" type="password">@error('password')<p class="field-error">{{ $message }}</p>@enderror</div>
                    <div><label for="password_confirmation">Konfirmasi password baru</label><input id="password_confirmation" name="password_confirmation" type="password"></div>
                </div>
                <button type="submit" class="button">Simpan profil</button>
            </form>
        </section>
    </main>
@endsection
