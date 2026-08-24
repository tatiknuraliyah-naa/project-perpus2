@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Perpustakaan Acitya Wiguna</p><h1>Katalog Buku</h1><p class="muted">Temukan koleksi buku dan ketersediaannya secara langsung.</p></div>
            <a class="button button-secondary" href="{{ auth('petugas')->check() ? route('dashboard.petugas') : (auth('anggota')->user()->role === 'Siswa' ? route('dashboard.siswa') : route('dashboard.guru-karyawan')) }}">Dashboard</a>
        </header>
        <section class="content-card">
            <form method="GET" class="filter-form filter-form-wide">
                <input name="cari" value="{{ $search }}" placeholder="Judul, penulis, penerbit, kode, atau ISBN" aria-label="Cari buku">
                <select name="kategori_id" aria-label="Filter kategori"><option value="">Semua kategori</option>@foreach ($kategori as $item)<option value="{{ $item->id }}" @selected($kategoriId === $item->id)>{{ $item->kode_ddc }} — {{ $item->nama_kategori }}</option>@endforeach</select>
                <select name="jenis" aria-label="Filter jenis buku"><option value="">Semua jenis</option>@foreach (['Umum', 'Paket'] as $nilaiJenis)<option value="{{ $nilaiJenis }}" @selected($jenis === $nilaiJenis)>{{ $nilaiJenis }}</option>@endforeach</select>
                <label class="check-label"><input name="tersedia" type="checkbox" value="1" @checked($ketersediaan)> Hanya yang tersedia</label>
                <button type="submit" class="button">Cari</button><a class="text-link" href="{{ route('katalog.index') }}">Reset</a>
            </form>
            <div class="book-grid">
                @forelse ($buku as $item)
                    <article class="book-card"><a class="book-cover" href="{{ route('katalog.show', $item) }}"><img src="{{ $item->coverUrl() }}" alt="Cover {{ $item->judul }}"></a><div class="book-card-body"><p class="table-note">{{ $item->kategori->nama_kategori }} · {{ $item->jenis_buku }}</p><h2><a href="{{ route('katalog.show', $item) }}">{{ $item->judul }}</a></h2><p class="muted">{{ $item->penulis ?: 'Penulis tidak dicantumkan' }}</p><p><span class="badge {{ $item->stok_tersedia > 0 ? 'badge-success' : 'badge-muted' }}">{{ $item->stok_tersedia > 0 ? $item->stok_tersedia.' tersedia' : 'Stok habis' }}</span></p></div></article>
                @empty<p class="empty-state catalog-empty">Buku yang Anda cari belum tersedia.</p>@endforelse
            </div>
            {{ $buku->links() }}
        </section>
    </main>
@endsection
