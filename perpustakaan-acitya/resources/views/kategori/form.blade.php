@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Manajemen koleksi</p><h1>{{ $kategori->exists ? 'Edit Kategori' : 'Tambah Kategori' }}</h1><p class="muted">Isi data klasifikasi buku dengan lengkap.</p></div>
            <a class="button button-secondary" href="{{ route('kategori.index') }}">Kembali</a>
        </header>
        <section class="content-card form-card">
            <form method="POST" action="{{ $kategori->exists ? route('kategori.update', $kategori) : route('kategori.store') }}" class="form-stack">
                @csrf @if ($kategori->exists) @method('PUT') @endif
                <div><label for="kode_ddc">Kode DDC</label><input id="kode_ddc" name="kode_ddc" value="{{ old('kode_ddc', $kategori->kode_ddc) }}" maxlength="10" required>@error('kode_ddc')<p class="field-error">{{ $message }}</p>@enderror</div>
                <div><label for="nama_kategori">Nama kategori</label><input id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" maxlength="100" required>@error('nama_kategori')<p class="field-error">{{ $message }}</p>@enderror</div>
                <div><label for="deskripsi">Deskripsi <span class="optional">(opsional)</span></label><textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>@error('deskripsi')<p class="field-error">{{ $message }}</p>@enderror</div>
                <button type="submit" class="button">{{ $kategori->exists ? 'Simpan perubahan' : 'Simpan kategori' }}</button>
            </form>
        </section>
    </main>
@endsection
