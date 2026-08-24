@extends('layouts.app')

@section('content')
    <main class="app-page"><header class="page-header"><div><p class="eyebrow">Layanan Perpustakaan</p><h1>Ajukan Peminjaman</h1><p class="muted">Pengajuan akan diperiksa petugas sebelum buku dapat dipinjam.</p></div><a class="button button-secondary" href="{{ route('peminjaman.index') }}">Riwayat peminjaman</a></header>
        <section class="content-card form-card">@if ($anggota->status !== 'Aktif')<div class="alert alert-error">Status keanggotaan Anda adalah {{ $anggota->status }}, sehingga tidak dapat mengajukan peminjaman baru.</div>@elseif ($buku->isEmpty())<p class="empty-state">Belum ada buku yang tersedia untuk diajukan.</p>@else<form method="POST" action="{{ route('peminjaman.store') }}" class="form-stack">@csrf
            <div><label for="buku_id">Buku yang diajukan</label><select id="buku_id" name="buku_id" required><option value="">Pilih buku</option>@foreach ($buku as $item)<option value="{{ $item->id }}" @selected((int) old('buku_id', $selectedBukuId) === $item->id)>{{ $item->judul }} — {{ $item->penulis ?: 'Tanpa penulis' }} ({{ $item->jenis_buku }}, stok {{ $item->stok_tersedia }})</option>@endforeach</select>@error('buku_id')<p class="field-error">{{ $message }}</p>@enderror</div><p class="table-note">Buku umum maksimal 3 buku yang masih berjalan (termasuk pengajuan menunggu). Masa pinjam dan tanggal jatuh tempo ditentukan saat petugas mengonfirmasi.</p><button type="submit" class="button">Kirim pengajuan</button>
        </form>@endif</section>
    </main>
@endsection
