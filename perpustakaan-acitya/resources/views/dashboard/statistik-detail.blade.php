@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Detail statistik</p>
                <h1>{{ $title }}</h1>
                <p class="muted">Data di bawah merupakan rincian dari statistik yang dipilih di Dashboard.</p>
            </div>
            <a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Kembali ke dashboard</a>
        </header>

        <section class="content-card">
            <div class="table-wrap">
                @if ($viewType === 'buku')
                    <table>
                        <thead>
                            <tr>
                                <th>Buku</th>
                                <th>Kategori</th>
                                <th>Rak</th>
                                <th>Stok tersedia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->judul }}</strong>
                                        <br>
                                        <span class="table-note">{{ $item->kode_buku }}</span>
                                    </td>
                                    <td>{{ $item->kategori?->nama_kategori ?: '—' }}</td>
                                    <td>{{ $item->lokasi_rak ?: '—' }}</td>
                                    <td>{{ $item->stok_tersedia }} / {{ $item->stok }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">Tidak ada data untuk statistik ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @elseif ($viewType === 'anggota')
                    <table>
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Peran</th>
                                <th>Identitas</th>
                                <th>Peminjaman</th>
                                <th>Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->nama }}</strong>
                                        <br>
                                        <span class="table-note">{{ $item->email ?: 'Email belum diisi' }}</span>
                                    </td>
                                    <td>{{ $item->role }}</td>
                                    <td>{{ $item->role === 'Siswa' ? $item->nis_nisn : $item->nip }}</td>
                                    <td>{{ $item->peminjaman_count }}</td>
                                    <td>{{ $item->kunjungan_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Tidak ada anggota.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @elseif ($viewType === 'kunjungan')
                    <table>
                        <thead>
                            <tr>
                                <th>Pengunjung</th>
                                <th>Peran</th>
                                <th>Waktu</th>
                                <th>Tujuan</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->anggota->nama }}</strong>
                                        <br>
                                        <span class="table-note">
                                            {{ $item->anggota->role === 'Siswa' ? trim(($item->anggota->kelas ?? '') . ' ' . ($item->anggota->jurusan ?? '')) : $item->anggota->nip }}
                                        </span>
                                    </td>
                                    <td>{{ $item->anggota->role }}</td>
                                    <td>{{ $item->tanggal->format('d M Y') }} · {{ date('H:i', strtotime($item->jam_masuk)) }}</td>
                                    <td>{{ $item->tujuan }}</td>
                                    <td>{{ $item->catatan ?: '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Belum ada kunjungan yang sesuai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <table>
                        <thead>
                            <tr>
                                <th>Anggota</th>
                                <th>Buku</th>
                                <th>Tanggal pinjam</th>
                                <th>Jatuh tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->anggota->nama }}</strong>
                                        <br>
                                        <span class="table-note">
                                            {{ $item->anggota->role === 'Siswa' ? trim(($item->anggota->kelas ?? '') . ' ' . ($item->anggota->jurusan ?? '')) : $item->anggota->nip }}
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($item->detailPeminjaman as $detail)
                                            {{ $detail->buku->judul }}
                                            @if (! $loop->last)
                                                <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $item->tanggal_pinjam?->format('d M Y') ?: 'Menunggu' }}</td>
                                    <td>{{ $item->tanggal_jatuh_tempo?->format('d M Y') ?: '—' }}</td>
                                    <td>
                                        <span class="badge {{ $item->status === 'Terlambat' ? 'badge-warning' : ($item->status === 'Dikembalikan' ? 'badge-success' : 'badge-muted') }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-state">Tidak ada transaksi yang sesuai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif
            </div>

            {{ $data->links() }}
        </section>
    </main>
@endsection
