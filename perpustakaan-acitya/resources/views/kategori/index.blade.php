@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Manajemen koleksi</p>
                <h1>Kategori Buku</h1>
                <p class="muted">Kelompokkan koleksi berdasarkan klasifikasi DDC.</p>
            </div>
            <div class="page-actions">
                <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a>
                <a class="button" href="{{ route('kategori.create') }}">Tambah kategori</a>
            </div>
        </header>

        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif

        <section class="content-card">
            <form method="GET" class="filter-form">
                <label class="sr-only" for="cari">Cari kategori</label>
                <input id="cari" name="cari" value="{{ $search }}" placeholder="Cari kode DDC atau nama kategori">
                <button type="submit" class="button">Cari</button>
                @if ($search)<a class="text-link" href="{{ route('kategori.index') }}">Reset</a>@endif
            </form>

            <div class="table-wrap">
                <table>
                    <thead><tr><th>Kode DDC</th><th>Nama kategori</th><th>Deskripsi</th><th>Jumlah buku</th><th>Aksi</th></tr></thead>
                    <tbody>
                        @forelse ($kategori as $item)
                            <tr>
                                <td>{{ $item->kode_ddc }}</td><td>{{ $item->nama_kategori }}</td>
                                <td>{{ $item->deskripsi ?: '—' }}</td><td>{{ $item->buku_count }}</td>
                                <td class="row-actions"><a class="text-link" href="{{ route('kategori.edit', $item) }}">Edit</a><form method="POST" action="{{ route('kategori.destroy', $item) }}" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')<button class="link-button" type="submit">Hapus</button></form></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-state">Belum ada kategori yang sesuai.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $kategori->links() }}
        </section>
    </main>
@endsection
