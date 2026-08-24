@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Petugas</p>
                <h1>Konfirmasi Pengembalian</h1>
                <p class="muted">Catat kondisi buku sebelum transaksi peminjaman ditutup.</p>
            </div>
            <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a>
        </header>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="content-card">
            <form method="GET" class="filter-form">
                <input name="cari" value="{{ $search }}" placeholder="ID transaksi, nama, NIS/NISN, atau NIP" aria-label="Cari transaksi">
                <button type="submit" class="button">Cari</button>
                <a class="text-link" href="{{ route('pengembalian.index') }}">Reset</a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead><tr><th>Transaksi</th><th>Anggota</th><th>Buku</th><th>Jatuh Tempo</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($peminjaman as $item)
                            @php
                                $terlambat = $item->tanggal_jatuh_tempo?->isPast()
                                    && ! $item->tanggal_jatuh_tempo?->isToday();
                            @endphp
                            <tr>
                                <td>#{{ $item->id }}<br><span class="table-note">{{ $item->tanggal_pinjam?->format('d M Y') }}</span></td>
                                <td><strong>{{ $item->anggota->nama }}</strong><br><span class="table-note">{{ $item->anggota->role === 'Siswa' ? $item->anggota->nis_nisn : $item->anggota->nip }}</span></td>
                                <td>
                                    @foreach ($item->detailPeminjaman as $detail)
                                        {{ $detail->buku->judul }}
                                        @if (! $loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $item->tanggal_jatuh_tempo?->format('d M Y') ?: '—' }}</td>
                                <td><span class="badge {{ $terlambat || $item->status === 'Terlambat' ? 'badge-warning' : 'badge-success' }}">{{ $terlambat ? 'Terlambat' : $item->status }}</span></td>
                                <td><a class="button" href="{{ route('pengembalian.create', $item) }}">Periksa</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="empty-state">Tidak ada transaksi yang menunggu pengembalian.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $peminjaman->links() }}
        </section>
    </main>
@endsection
