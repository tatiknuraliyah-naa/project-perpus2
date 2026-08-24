@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Layanan Petugas</p>
                <h1>Kelola Penggantian Buku</h1>
                <p class="muted">Transaksi ditutup hanya setelah pengganti diterima.</p>
            </div>
            <a class="button button-secondary" href="{{ route('penggantian.index') }}">Kembali</a>
        </header>

        <section class="content-card form-card">
            <dl class="detail-list">
                <div><dt>Transaksi</dt><dd>#{{ $penggantian->pengembalian->peminjaman->id }}</dd></div>
                <div><dt>Anggota</dt><dd>{{ $penggantian->pengembalian->peminjaman->anggota->nama }}</dd></div>
                <div><dt>Buku hilang</dt><dd>{{ $penggantian->buku_hilang }}</dd></div>
                <div><dt>Tanggal laporan</dt><dd>{{ $penggantian->tanggal_lapor->format('d M Y') }}</dd></div>
            </dl>

            <form method="POST" action="{{ route('penggantian.update', $penggantian) }}" class="form-stack">
                @csrf
                @method('PUT')
                <div>
                    <label for="buku_pengganti">Buku pengganti</label>
                    <input id="buku_pengganti" name="buku_pengganti" maxlength="255" value="{{ old('buku_pengganti', $penggantian->buku_pengganti) }}" @disabled($penggantian->status === 'Selesai')>
                    @error('buku_pengganti')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="status">Status penggantian</label>
                    <select id="status" name="status" required @disabled($penggantian->status === 'Selesai')>
                        @foreach (['Menunggu', 'Diverifikasi', 'Selesai'] as $nilaiStatus)
                            <option value="{{ $nilaiStatus }}" @selected(old('status', $penggantian->status) === $nilaiStatus)>{{ $nilaiStatus }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="catatan">Catatan petugas <span class="optional">(opsional)</span></label>
                    <textarea id="catatan" name="catatan" rows="4" maxlength="1000" @disabled($penggantian->status === 'Selesai')>{{ old('catatan', $penggantian->catatan) }}</textarea>
                    @error('catatan')<p class="field-error">{{ $message }}</p>@enderror
                </div>
                @if ($penggantian->status === 'Selesai')
                    <p class="table-note">Penggantian diselesaikan pada {{ $penggantian->tanggal_selesai?->format('d M Y') }} dan stok telah diperbarui.</p>
                @else
                    <p class="table-note">Saat status diubah menjadi Selesai, stok total dan stok tersedia akan ditambah sesuai jumlah buku pengganti.</p>
                    <button type="submit" class="button">Simpan penggantian</button>
                @endif
            </form>
        </section>
    </main>
@endsection
