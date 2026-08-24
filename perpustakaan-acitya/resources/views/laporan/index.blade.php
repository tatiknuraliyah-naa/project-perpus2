@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Administrasi Perpustakaan</p>
                <h1>Laporan Perpustakaan</h1>
                <p class="muted">Rekap transaksi dan kunjungan berdasarkan periode yang dipilih.</p>
            </div>

            <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a>
        </header>

        <section class="content-card">
            <form method="GET" class="filter-form filter-form-wide">
                <label>
                    <span class="sr-only">Tanggal mulai</span>
                    <input type="date" name="mulai" value="{{ $mulai }}" aria-label="Tanggal mulai">
                </label>
                <label>
                    <span class="sr-only">Tanggal sampai</span>
                    <input type="date" name="sampai" value="{{ $sampai }}" aria-label="Tanggal sampai">
                </label>
                <button type="submit" class="button">Tampilkan</button>
            </form>

            @error('sampai')
                <p class="field-error">{{ $message }}</p>
            @enderror

            <div class="report-stats">
                <article class="stat-card"><strong>{{ $ringkasan['peminjaman'] }}</strong><span>Peminjaman</span></article>
                <article class="stat-card"><strong>{{ $ringkasan['dikembalikan'] }}</strong><span>Dikembalikan</span></article>
                <article class="stat-card"><strong>{{ $ringkasan['terlambat'] }}</strong><span>Terlambat</span></article>
                <article class="stat-card"><strong>{{ $ringkasan['pengembalian'] }}</strong><span>Pengembalian</span></article>
                <article class="stat-card"><strong>{{ $ringkasan['kunjungan'] }}</strong><span>Kunjungan</span></article>
            </div>
        </section>

        <section class="content-card report-section">
            <h2>Buku paling sering dipinjam</h2>
            @forelse ($bukuTerpopuler as $buku)
                <div class="report-ranking"><span>{{ $loop->iteration }}.</span><strong>{{ $buku->judul }}</strong><span>{{ $buku->total_dipinjam }} kali</span></div>
            @empty
                <p class="empty-state">Belum ada peminjaman pada periode ini.</p>
            @endforelse
        </section>

        <section class="content-card report-section">
            <h2>Rincian peminjaman</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr><th>Tanggal</th><th>Anggota</th><th>Buku</th><th>Status</th><th>Jatuh tempo</th><th>Dikembalikan</th></tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman as $item)
                            <tr>
                                <td>{{ $item->tanggal_pinjam?->format('d M Y') }}</td>
                                <td><strong>{{ $item->anggota->nama }}</strong><br><span class="table-note">{{ $item->anggota->role === 'Siswa' ? $item->anggota->nis_nisn : $item->anggota->nip }}</span></td>
                                <td>
                                    @foreach ($item->detailPeminjaman as $detail)
                                        {{ $detail->buku->judul }}
                                        @if (! $loop->last)<br>@endif
                                    @endforeach
                                </td>
                                <td><span class="badge {{ $item->status === 'Dikembalikan' ? 'badge-success' : ($item->status === 'Terlambat' ? 'badge-warning' : 'badge-muted') }}">{{ $item->status }}</span></td>
                                <td>{{ $item->tanggal_jatuh_tempo?->format('d M Y') ?: '—' }}</td>
                                <td>{{ $item->pengembalian?->tanggal_kembali?->format('d M Y') ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="empty-state">Belum ada data peminjaman pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $peminjaman->links() }}
        </section>
    </main>
@endsection
