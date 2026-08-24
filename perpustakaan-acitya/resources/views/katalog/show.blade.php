@extends('layouts.app')

@section('content')
    <main class="app-page">
        <p><a class="text-link" href="{{ route('katalog.index') }}">← Kembali ke katalog</a></p>
        <section class="content-card book-detail">
            <div class="book-cover book-cover-large"><img src="{{ $buku->coverUrl() }}" alt="Cover {{ $buku->judul }}"></div>
            <div><p class="eyebrow">{{ $buku->kategori->nama_kategori }}</p><h1>{{ $buku->judul }}</h1><p class="muted">{{ $buku->penulis ?: 'Penulis tidak dicantumkan' }}</p><p><span class="badge {{ $buku->stok_tersedia > 0 ? 'badge-success' : 'badge-muted' }}">{{ $buku->stok_tersedia > 0 ? $buku->stok_tersedia.' buku tersedia' : 'Stok sedang habis' }}</span></p>@if (auth('anggota')->check() && $buku->stok_tersedia > 0)<p><a class="button" href="{{ route('peminjaman.create', ['buku_id' => $buku->id]) }}">Ajukan peminjaman</a></p>@endif<dl class="detail-list"><div><dt>Kode buku</dt><dd>{{ $buku->kode_buku }}</dd></div><div><dt>ISBN</dt><dd>{{ $buku->isbn ?: '—' }}</dd></div><div><dt>Penerbit</dt><dd>{{ $buku->penerbit ?: '—' }}</dd></div><div><dt>Tahun terbit</dt><dd>{{ $buku->tahun_terbit ?: '—' }}</dd></div><div><dt>Lokasi rak</dt><dd>{{ $buku->lokasi_rak ?: '—' }}</dd></div><div><dt>Jenis</dt><dd>{{ $buku->jenis_buku }}</dd></div></dl><h2>Deskripsi</h2><p class="muted">{{ $buku->deskripsi ?: 'Deskripsi buku belum tersedia.' }}</p></div>
        </section>
    </main>
@endsection
