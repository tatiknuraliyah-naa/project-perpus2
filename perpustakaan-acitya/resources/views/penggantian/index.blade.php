@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Petugas</p>
                <h1>Penggantian Buku Hilang</h1>
                <p class="muted">Selesaikan transaksi setelah buku pengganti diterima dan diverifikasi.</p>
            </div>
            <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a>
        </header>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="content-card">
            <form method="GET" class="filter-form">
                <select name="status" aria-label="Filter status penggantian">
                    <option value="">Semua status</option>
                    @foreach (['Menunggu', 'Diverifikasi', 'Selesai'] as $nilaiStatus)
                        <option value="{{ $nilaiStatus }}" @selected($status === $nilaiStatus)>{{ $nilaiStatus }}</option>
                    @endforeach
                </select>
                <button type="submit" class="button">Filter</button>
                <a class="text-link" href="{{ route('penggantian.index') }}">Reset</a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead><tr><th>Transaksi</th><th>Anggota</th><th>Buku hilang</th><th>Dilaporkan</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($penggantian as $item)
                            <tr>
                                <td>#{{ $item->pengembalian->peminjaman->id }}</td>
                                <td>{{ $item->pengembalian->peminjaman->anggota->nama }}</td>
                                <td>{{ $item->buku_hilang }}</td>
                                <td>{{ $item->tanggal_lapor->format('d M Y') }}</td>
                                <td><span class="badge {{ $item->status === 'Selesai' ? 'badge-success' : 'badge-warning' }}">{{ $item->status }}</span></td>
                                <td><a class="button" href="{{ route('penggantian.edit', $item) }}">Kelola</a></td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="empty-state">Tidak ada data penggantian buku.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $penggantian->links() }}
        </section>
    </main>
@endsection
