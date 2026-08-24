@extends('layouts.app')

@section('content')
    <main class="app-page">

        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Petugas</p>
                <h1>Konfirmasi Peminjaman</h1>
                <p class="muted">
                    Periksa pengajuan sebelum stok buku dikurangi.
                </p>
            </div>

            <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">
                Dashboard
            </a>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="content-card">

            <form method="GET" class="filter-form filter-form-wide">
                <input
                    name="cari"
                    value="{{ $search }}"
                    placeholder="Nama, NIS/NISN, atau NIP"
                    aria-label="Cari anggota"
                >

                <select name="status" aria-label="Filter status">
                    <option value="">Semua status</option>

                    @foreach ([
                        'Menunggu',
                        'Dipinjam',
                        'Dikembalikan',
                        'Terlambat',
                        'Penggantian Buku'
                    ] as $nilaiStatus)
                        <option
                            value="{{ $nilaiStatus }}"
                            @selected($status === $nilaiStatus)
                        >
                            {{ $nilaiStatus }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="button">
                    Filter
                </button>

                <a
                    class="text-link"
                    href="{{ route('peminjaman.petugas.index') }}"
                >
                    Reset
                </a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Anggota</th>
                            <th>Buku</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Diajukan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($peminjaman as $item)
                            <tr>
                                <td>
                                    <strong>
                                        {{ $item->anggota->nama }}
                                    </strong>

                                    <br>

                                    <span class="table-note">
                                        {{ $item->anggota->role === 'Siswa'
                                            ? $item->anggota->nis_nisn
                                            : $item->anggota->nip }}
                                    </span>
                                </td>

                                <td>
                                    @foreach ($item->detailPeminjaman as $detail)
                                        {{ $detail->buku->judul }}

                                        @if (! $loop->last)
                                            <br>
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    {{ $item->jenis_peminjaman }}
                                </td>

                                <td>
                                    <span
                                        class="badge {{ $item->status === 'Menunggu'
                                            ? 'badge-muted'
                                            : 'badge-success' }}"
                                    >
                                        {{ $item->status }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->created_at->format('d M Y H:i') }}
                                </td>

                                <td>
                                    @if ($item->status === 'Menunggu')
                                        <a
                                            class="button"
                                            href="{{ route('peminjaman.confirm.form', $item) }}"
                                        >
                                            Periksa
                                        </a>
                                    @else
                                        <span class="table-note">
                                            {{ $item->petugas?->nama ?: '—' }}
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="empty-state">
                                    Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $peminjaman->links() }}

        </section>
    </main>
@endsection