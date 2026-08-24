@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Manajemen koleksi</p><h1>Data Buku</h1><p class="muted">Kelola koleksi dan ketersediaan buku.</p></div>
            <div class="page-actions"><a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a><a class="button" href="{{ route('buku.create') }}">Tambah buku</a></div>
        </header>
        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        <section class="content-card">
            <form method="GET" class="filter-form filter-form-wide">
                <input name="cari" value="{{ $search }}" placeholder="Kode, judul, penulis, atau ISBN" aria-label="Cari buku">
                <select name="kategori_id" aria-label="Filter kategori"><option value="">Semua kategori</option>@foreach ($kategori as $item)<option value="{{ $item->id }}" @selected($kategoriId === $item->id)>{{ $item->kode_ddc }} — {{ $item->nama_kategori }}</option>@endforeach</select>
                <select name="status" aria-label="Filter status"><option value="">Semua status</option><option value="Tersedia" @selected($status === 'Tersedia')>Tersedia</option><option value="Tidak Aktif" @selected($status === 'Tidak Aktif')>Tidak Aktif</option></select>
                <button type="submit" class="button">Filter</button><a class="text-link" href="{{ route('buku.index') }}">Reset</a>
            </form>
            <div class="table-wrap"><table><thead><tr><th>Foto</th><th>Buku</th><th>Kategori</th><th>Rak</th><th>Stok</th><th>Status</th><th>Aksi</th></tr></thead><tbody>
                @forelse ($buku as $item)
                    <tr><td><div class="book-thumbnail"><img src="{{ $item->coverUrl() }}" alt="Cover {{ $item->judul }}"></div></td><td><strong>{{ $item->judul }}</strong><br><span class="table-note">{{ $item->kode_buku }} · {{ $item->penulis ?: 'Penulis tidak dicantumkan' }}</span></td><td>{{ $item->kategori->nama_kategori }}</td><td>{{ $item->lokasi_rak ?: '—' }}</td><td>{{ $item->stok_tersedia }} / {{ $item->stok }}</td><td><span class="badge {{ $item->status === 'Tersedia' ? 'badge-success' : 'badge-muted' }}">{{ $item->status }}</span></td><td class="row-actions"><a class="text-link" href="{{ route('buku.edit', $item) }}">Edit</a><form method="POST" action="{{ route('buku.destroy', $item) }}" onsubmit="return confirm('Hapus data buku ini?')">@csrf @method('DELETE')<button class="link-button" type="submit">Hapus</button></form></td></tr>
                @empty<tr><td colspan="7" class="empty-state">Belum ada buku yang sesuai.</td></tr>@endforelse
            </tbody></table></div>
            {{ $buku->links() }}
        </section>
    </main>
@endsection
