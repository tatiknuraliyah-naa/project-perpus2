@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Aktivitas Literasi</p>
                <h1>Leaderboard</h1>
                <p class="muted">Peringkat dihitung dari buku yang dipinjam, pengembalian tepat waktu, kunjungan, dan achievement.</p>
            </div>
            <a class="button-secondary button" href="{{ auth('petugas')->check() ? route('dashboard.petugas') : (auth('anggota')->user()->role === 'Siswa' ? route('dashboard.siswa') : route('dashboard.guru-karyawan')) }}">Kembali</a>
        </header>

        <section class="content-card">
            <form class="filter-form filter-form-wide" method="GET" action="{{ route('leaderboard.index') }}">
                <label>
                    <span class="sr-only">Periode</span>
                    <select name="periode" onchange="this.form.submit()">
                        @foreach (['Bulanan', 'Semester', 'Tahunan'] as $opsi)
                            <option value="{{ $opsi }}" @selected($periode === $opsi)>{{ $opsi }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span class="sr-only">Tahun</span>
                    <select name="tahun" onchange="this.form.submit()">
                        @for ($opsiTahun = now()->year; $opsiTahun >= now()->year - 4; $opsiTahun--)
                            <option value="{{ $opsiTahun }}" @selected($tahun === $opsiTahun)>{{ $opsiTahun }}</option>
                        @endfor
                    </select>
                </label>
                @if ($periode === 'Bulanan')
                    <label>
                        <span class="sr-only">Bulan</span>
                        <select name="bulan" onchange="this.form.submit()">
                            @for ($opsiBulan = 1; $opsiBulan <= 12; $opsiBulan++)
                                <option value="{{ $opsiBulan }}" @selected($bulan === $opsiBulan)>{{ \Carbon\Carbon::create()->month($opsiBulan)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </label>
                @endif
                @if ($periode === 'Semester')
                    <label>
                        <span class="sr-only">Semester</span>
                        <select name="semester" onchange="this.form.submit()">
                            <option value="1" @selected($semester === 1)>Semester 1</option>
                            <option value="2" @selected($semester === 2)>Semester 2</option>
                        </select>
                    </label>
                @endif
                <noscript><button type="submit">Tampilkan</button></noscript>
            </form>

            <p class="table-note">Periode {{ $mulai->translatedFormat('d F Y') }} sampai {{ $selesai->translatedFormat('d F Y') }}.</p>

            @if ($leaderboard->isEmpty())
                <p class="empty-state">Belum ada data leaderboard pada periode ini.</p>
            @else
                <div class="table-wrap">
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>Anggota</th>
                                <th>Buku Dipinjam</th>
                                <th>Kunjungan</th>
                                <th>Achievement</th>
                                <th>Total Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaderboard as $baris)
                                <tr @class(['is-current-user' => auth('anggota')->id() === $baris['anggota']->id])>
                                    <td><span class="rank rank-{{ min($baris['peringkat'], 4) }}">{{ $baris['peringkat'] }}</span></td>
                                    <td>
                                        <strong>{{ $baris['anggota']->nama }}</strong>
                                        <span class="member-meta">{{ $baris['anggota']->role === 'Siswa' ? trim(($baris['anggota']->kelas ?? '').' '.($baris['anggota']->jurusan ?? '')) : $baris['anggota']->jabatan }}</span>
                                    </td>
                                    <td>{{ $baris['buku_dipinjam'] }}</td>
                                    <td>{{ $baris['kunjungan'] }}</td>
                                    <td>{{ $baris['achievement'] }}</td>
                                    <td><strong>{{ number_format($baris['total_poin'], 0, ',', '.') }} poin</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </main>
@endsection
