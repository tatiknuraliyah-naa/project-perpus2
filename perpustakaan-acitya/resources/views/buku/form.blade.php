@extends('layouts.app')

@section('content')
    <main class="app-page"><header class="page-header"><div><p class="eyebrow">Manajemen koleksi</p><h1>{{ $buku->exists ? 'Edit Buku' : 'Tambah Buku' }}</h1><p class="muted">Stok tersedia tidak boleh lebih besar dari stok total.</p></div><a class="button button-secondary" href="{{ route('buku.index') }}">Kembali</a></header>
        <section class="content-card form-card"><form method="POST" enctype="multipart/form-data" action="{{ $buku->exists ? route('buku.update', $buku) : route('buku.store') }}" class="form-stack">
            @csrf @if ($buku->exists) @method('PUT') @endif
            <div class="form-grid"><div><label for="kategori_id">Kategori</label><select id="kategori_id" name="kategori_id" required><option value="">Pilih kategori</option>@foreach ($kategori as $item)<option value="{{ $item->id }}" @selected((string) old('kategori_id', $buku->kategori_id) === (string) $item->id)>{{ $item->kode_ddc }} — {{ $item->nama_kategori }}</option>@endforeach</select>@error('kategori_id')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="kode_buku">Kode buku</label><input id="kode_buku" name="kode_buku" value="{{ old('kode_buku', $buku->kode_buku) }}" maxlength="30" required>@error('kode_buku')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="judul">Judul</label><input id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" maxlength="255" required>@error('judul')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="isbn">ISBN <span class="optional">(opsional)</span></label><input id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" maxlength="20">@error('isbn')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="penulis">Penulis</label><input id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" maxlength="150">@error('penulis')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="penerbit">Penerbit</label><input id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" maxlength="150">@error('penerbit')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="tahun_terbit">Tahun terbit</label><input id="tahun_terbit" name="tahun_terbit" type="number" min="1000" max="{{ now()->year }}" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">@error('tahun_terbit')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="lokasi_rak">Lokasi rak</label><input id="lokasi_rak" name="lokasi_rak" value="{{ old('lokasi_rak', $buku->lokasi_rak) }}" maxlength="50">@error('lokasi_rak')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="jenis_buku">Jenis buku</label><select id="jenis_buku" name="jenis_buku" required>@foreach (['Umum', 'Paket'] as $jenis)<option value="{{ $jenis }}" @selected(old('jenis_buku', $buku->jenis_buku ?: 'Umum') === $jenis)>{{ $jenis }}</option>@endforeach</select>@error('jenis_buku')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="status">Status</label><select id="status" name="status" required>@foreach (['Tersedia', 'Tidak Aktif'] as $nilaiStatus)<option value="{{ $nilaiStatus }}" @selected(old('status', $buku->status ?: 'Tersedia') === $nilaiStatus)>{{ $nilaiStatus }}</option>@endforeach</select>@error('status')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="stok">Stok total</label><input id="stok" name="stok" type="number" min="0" value="{{ old('stok', $buku->stok ?? 0) }}" required>@error('stok')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="stok_tersedia">Stok tersedia</label><input id="stok_tersedia" name="stok_tersedia" type="number" min="0" value="{{ old('stok_tersedia', $buku->stok_tersedia ?? 0) }}" required>@error('stok_tersedia')<p class="field-error">{{ $message }}</p>@enderror</div></div>
            <div><label for="cover">Foto cover <span class="optional">(JPG, PNG, WEBP; maks. 2 MB)</span></label><div class="cover-upload"><div class="cover-preview" id="cover-preview"><img src="{{ $buku->coverUrl() }}" alt="Cover saat ini untuk {{ $buku->judul }}"></div><div><input id="cover" name="cover" type="file" accept="image/jpeg,image/png,image/webp" aria-describedby="cover-help"><p class="table-note" id="cover-help">Tambahkan foto cover agar buku mudah dikenali di katalog.</p>@if ($buku->cover)<p class="table-note">Cover saat ini: {{ basename($buku->cover) }}</p>@endif</div></div>@error('cover')<p class="field-error">{{ $message }}</p>@enderror</div>
            <div><label for="deskripsi">Deskripsi <span class="optional">(opsional)</span></label><textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $buku->deskripsi) }}</textarea>@error('deskripsi')<p class="field-error">{{ $message }}</p>@enderror</div><button type="submit" class="button">{{ $buku->exists ? 'Simpan perubahan' : 'Simpan buku' }}</button>
        </form></section>
    </main>
@endsection

@section('scripts')
<script>
document.getElementById('cover')?.addEventListener('change', function () {
    const file = this.files?.[0];
    const preview = document.getElementById('cover-preview');
    if (!file || !preview) return;

    const reader = new FileReader();
    reader.addEventListener('load', () => {
        preview.innerHTML = '<img src="' + reader.result + '" alt="Pratinjau foto cover yang dipilih">';
    });
    reader.readAsDataURL(file);
});
</script>
@endsection
