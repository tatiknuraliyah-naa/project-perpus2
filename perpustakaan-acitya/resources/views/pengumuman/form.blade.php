@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Informasi perpustakaan</p>
                <h1>{{ $pengumuman->exists ? 'Ubah' : 'Tambah' }} Pengumuman</h1>
                <p class="muted">Lengkapi informasi yang akan ditampilkan kepada anggota.</p>
            </div>
            <a class="button button-secondary" href="{{ route('pengumuman.index') }}">Kembali ke daftar</a>
        </header>

        <section class="content-card form-card">
            <form class="form-stack" method="POST" action="{{ $pengumuman->exists ? route('pengumuman.update', $pengumuman) : route('pengumuman.store') }}">
                @csrf
                @if ($pengumuman->exists)
                    @method('PUT')
                @endif

                <div>
                    <label for="judul">Judul</label>
                    <input id="judul" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                    @error('judul')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="isi">Isi pengumuman</label>
                    <textarea id="isi" name="isi" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                    @error('isi')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div class="form-grid">
                    <div><label for="tanggal_publish">Tanggal publish</label><input id="tanggal_publish" type="date" name="tanggal_publish" value="{{ old('tanggal_publish', optional($pengumuman->tanggal_publish)->format('Y-m-d') ?? today()->format('Y-m-d')) }}" required></div>
                    <div><label for="tanggal_berakhir">Tanggal berakhir</label><input id="tanggal_berakhir" type="date" name="tanggal_berakhir" value="{{ old('tanggal_berakhir', optional($pengumuman->tanggal_berakhir)->format('Y-m-d')) }}"></div>
                    <div><label for="status">Status</label><select id="status" name="status"><option value="Aktif" @selected(old('status', $pengumuman->status) === 'Aktif')>Aktif</option><option value="Tidak Aktif" @selected(old('status', $pengumuman->status) === 'Tidak Aktif')>Tidak Aktif</option></select></div>
                </div>
                @error('tanggal_berakhir')<p class="field-error">{{ $message }}</p>@enderror
                <div class="page-actions"><button type="submit" class="button">Simpan pengumuman</button><a class="button button-secondary" href="{{ route('pengumuman.index') }}">Batal</a></div>
            </form>
        </section>
    </main>
@endsection
