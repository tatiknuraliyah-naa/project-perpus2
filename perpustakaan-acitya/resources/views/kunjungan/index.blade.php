@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Perpustakaan Acitya Wiguna</p><h1>{{ $isPetugas ? 'Monitoring Kunjungan' : 'Riwayat Kunjungan' }}</h1><p class="muted">{{ $isPetugas ? 'Pantau aktivitas kunjungan anggota perpustakaan.' : 'Daftar kunjungan Anda di perpustakaan.' }}</p></div>
            <div class="page-actions">@if (! $isPetugas)<a class="button" href="{{ route('qr-kunjungan.camera') }}">Scan QR kunjungan</a><a class="button button-secondary" href="{{ route('kunjungan.create') }}">Isi manual</a>@endif<a class="button button-secondary" href="{{ $isPetugas ? route('dashboard.petugas') : (auth('anggota')->user()->role === 'Siswa' ? route('dashboard.siswa') : route('dashboard.guru-karyawan')) }}">Dashboard</a></div>
        </header>
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        <section class="content-card">
            <form method="GET" class="filter-form filter-form-wide">
                @if ($isPetugas)<input name="cari" value="{{ $search }}" placeholder="Nama, NIS/NISN, atau NIP" aria-label="Cari anggota">@endif
                <input name="tanggal" type="date" value="{{ $tanggal?->format('Y-m-d') }}" aria-label="Filter tanggal"><button type="submit" class="button">Filter</button><a class="text-link" href="{{ route('kunjungan.index') }}">Reset</a>
            </form>
            <div class="table-wrap"><table><thead><tr>@if ($isPetugas)<th>Anggota</th><th>Peran</th>@endif<th>Tanggal</th><th>Jam masuk</th><th>Tujuan</th><th>Catatan</th></tr></thead><tbody>
                @forelse ($kunjungan as $item)<tr>@if ($isPetugas)<td><strong>{{ $item->anggota->nama }}</strong><br><span class="table-note">{{ $item->anggota->role === 'Siswa' ? $item->anggota->nis_nisn : $item->anggota->nip }}</span></td><td>{{ $item->anggota->role }}</td>@endif<td>{{ $item->tanggal->format('d M Y') }}</td><td>{{ \Illuminate\Support\Carbon::parse($item->jam_masuk)->format('H:i') }}</td><td>{{ $item->tujuan }}</td><td>{{ $item->catatan ?: '—' }}</td></tr>@empty<tr><td colspan="{{ $isPetugas ? 6 : 4 }}" class="empty-state">Belum ada data kunjungan.</td></tr>@endforelse
            </tbody></table></div>
            {{ $kunjungan->links() }}
        </section>
    </main>
@endsection
