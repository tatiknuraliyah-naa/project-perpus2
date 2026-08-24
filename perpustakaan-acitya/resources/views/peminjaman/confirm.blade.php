@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Petugas</p>
                <h1>Periksa Pengajuan</h1>
                <p class="muted">Pastikan buku fisik dan identitas anggota sudah sesuai.</p>
            </div>

            <a class="button button-secondary" href="{{ route('peminjaman.petugas.index') }}">
                Kembali
            </a>
        </header>

        <section class="content-card form-card">
            <dl class="detail-list">
                <div>
                    <dt>Anggota</dt>
                    <dd>{{ $peminjaman->anggota->nama }} ({{ $peminjaman->anggota->role }})</dd>
                </div>
                <div>
                    <dt>Jenis peminjaman</dt>
                    <dd>{{ $peminjaman->jenis_peminjaman }}</dd>
                </div>
                <div>
                    <dt>Buku</dt>
                    <dd>
                        @foreach ($peminjaman->detailPeminjaman as $detail)
                            {{ $detail->buku->judul }}@if (! $loop->last), @endif
                        @endforeach
                    </dd>
                </div>
                <div>
                    <dt>Status anggota</dt>
                    <dd>{{ $peminjaman->anggota->status }}</dd>
                </div>
            </dl>

            <form method="POST" action="{{ route('peminjaman.confirm', $peminjaman) }}" class="form-stack">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div>
                        <label for="tanggal_pinjam">Tanggal pinjam</label>
                        <input
                            id="tanggal_pinjam"
                            name="tanggal_pinjam"
                            type="date"
                            value="{{ old('tanggal_pinjam', today()->format('Y-m-d')) }}"
                            required
                        >
                        @error('tanggal_pinjam')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_jatuh_tempo">Tanggal jatuh tempo</label>
                        <input
                            id="tanggal_jatuh_tempo"
                            name="tanggal_jatuh_tempo"
                            type="date"
                            value="{{ old('tanggal_jatuh_tempo', today()->addDays(7)->format('Y-m-d')) }}"
                            required
                        >
                        @error('tanggal_jatuh_tempo')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <p class="table-note">
                    Untuk buku umum, gunakan masa peminjaman tepat 7 hari sesuai PRD.
                    Buku paket dapat disesuaikan dengan kebijakan sekolah.
                </p>

                <button type="submit" class="button">Konfirmasi dan kurangi stok</button>
            </form>
        </section>
    </main>
@endsection
