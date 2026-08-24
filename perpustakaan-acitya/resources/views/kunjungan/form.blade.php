@extends('layouts.app')

@section('content')
    <main class="app-page"><header class="page-header"><div><p class="eyebrow">Perpustakaan Acitya Wiguna</p><h1>Isi Buku Kunjungan</h1><p class="muted">Kunjungan dicatat menggunakan tanggal dan jam server.</p></div><a class="button button-secondary" href="{{ route('kunjungan.index') }}">Kembali</a></header>
        <section class="content-card form-card">@if ($sudahMengisi)<div class="alert alert-success">Kunjungan Anda hari ini sudah tercatat. Terima kasih telah berkunjung.</div>@else<form method="POST" action="{{ route('kunjungan.store') }}" class="form-stack">@csrf
            <div><label for="tujuan">Tujuan kunjungan</label><select id="tujuan" name="tujuan" required><option value="">Pilih tujuan</option>@foreach (['Membaca', 'Meminjam', 'Mengembalikan', 'Belajar', 'Referensi', 'Lainnya'] as $tujuan)<option value="{{ $tujuan }}" @selected(old('tujuan') === $tujuan)>{{ $tujuan }}</option>@endforeach</select>@error('tujuan')<p class="field-error">{{ $message }}</p>@enderror</div><div><label for="catatan">Catatan <span class="optional">(opsional)</span></label><textarea id="catatan" name="catatan" rows="4" maxlength="1000" placeholder="Contoh: mencari referensi tugas.">{{ old('catatan') }}</textarea>@error('catatan')<p class="field-error">{{ $message }}</p>@enderror</div><button type="submit" class="button">Catat kunjungan</button>
        </form>@endif</section>
    </main>
@endsection
