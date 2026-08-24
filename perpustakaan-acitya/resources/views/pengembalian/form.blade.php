@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Layanan Petugas</p><h1>Periksa Pengembalian</h1><p class="muted">Pastikan kondisi fisik buku sebelum menyelesaikan transaksi.</p></div>
            <a class="button button-secondary" href="{{ route('pengembalian.index') }}">Kembali</a>
        </header>

        <section class="content-card form-card">
            <dl class="detail-list">
                <div><dt>Anggota</dt><dd>{{ $peminjaman->anggota->nama }} ({{ $peminjaman->anggota->role }})</dd></div>
                <div><dt>Tanggal pinjam</dt><dd>{{ $peminjaman->tanggal_pinjam?->format('d M Y') }}</dd></div>
                <div><dt>Jatuh tempo</dt><dd>{{ $peminjaman->tanggal_jatuh_tempo?->format('d M Y') }}</dd></div>
                <div>
                    <dt>Buku</dt>
                    <dd>
                        @foreach ($peminjaman->detailPeminjaman as $detail)
                            {{ $detail->buku->judul }} ({{ $detail->jumlah }})
                            @if (! $loop->last)
                                <br>
                            @endif
                        @endforeach
                    </dd>
                </div>
            </dl>

            <form method="POST" action="{{ route('pengembalian.store', $peminjaman) }}" class="form-stack">
                @csrf
                <div class="form-grid">
                    <div>
                        <label for="tanggal_kembali">Tanggal pengembalian</label>
                        <input id="tanggal_kembali" name="tanggal_kembali" type="date" value="{{ old('tanggal_kembali', today()->format('Y-m-d')) }}" max="{{ today()->format('Y-m-d') }}" required>
                        @error('tanggal_kembali')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="kondisi">Kondisi buku</label>
                        <select id="kondisi" name="kondisi" required>
                            <option value="">Pilih kondisi</option>
                            @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'] as $kondisi)
                                <option value="{{ $kondisi }}" @selected(old('kondisi') === $kondisi)>{{ $kondisi }}</option>
                            @endforeach
                        </select>
                        @error('kondisi')
                            <p class="field-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="catatan">Catatan petugas <span class="optional">(opsional)</span></label>
                    <textarea id="catatan" name="catatan" rows="4" maxlength="1000">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
                <p class="table-note">Kondisi Baik atau Rusak Ringan mengembalikan stok tersedia. Rusak Berat mengurangi stok total karena eksemplar tidak layak edar. Hilang tidak menambah stok dan mengalihkan transaksi ke penggantian buku.</p>
                <button type="submit" class="button">Simpan pengembalian</button>
            </form>
        </section>
    </main>
@endsection
