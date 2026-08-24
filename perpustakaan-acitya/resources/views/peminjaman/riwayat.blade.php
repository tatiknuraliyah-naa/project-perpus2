@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Perpustakaan</p>
                <h1>Riwayat Peminjaman</h1>
                <p class="muted">Pantau status pengajuan dan transaksi buku Anda.</p>
            </div>
            <div class="page-actions">
                <a class="button" href="{{ route('peminjaman.create') }}">Ajukan peminjaman</a>
                <a class="button button-secondary" href="{{ auth('anggota')->user()->role === 'Siswa' ? route('dashboard.siswa') : route('dashboard.guru-karyawan') }}">Dashboard</a>
            </div>
        </header>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="content-card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Tanggal pinjam</th>
                            <th>Jatuh tempo</th>
                            <th>Pengembalian</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($peminjaman as $item)
                            <tr>
                                <td>
                                    @foreach ($item->detailPeminjaman as $detail)
                                        <strong>{{ $detail->buku->judul }}</strong>
                                        @if (! $loop->last)<br>@endif
                                    @endforeach
                                </td>
                                <td>{{ $item->jenis_peminjaman }}</td>
                                <td><span class="badge {{ $item->status === 'Dipinjam' ? 'badge-success' : 'badge-muted' }}">{{ $item->status }}</span></td>
                                <td>{{ $item->tanggal_pinjam?->format('d M Y') ?: 'Menunggu konfirmasi' }}</td>
                                <td>{{ $item->tanggal_jatuh_tempo?->format('d M Y') ?: '—' }}</td>
                                <td>
                                    @if ($item->pengembalian)
                                        {{ $item->pengembalian->tanggal_kembali->format('d M Y') }}
                                        <br>
                                        <span class="table-note">{{ $item->pengembalian->kondisi }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td>{{ $item->petugas?->nama ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="empty-state">Belum ada riwayat peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $peminjaman->links() }}
        </section>
    </main>
@endsection
