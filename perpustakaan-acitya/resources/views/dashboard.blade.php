@extends('layouts.app')

@section('content')
    @php
        $isPetugas = auth('petugas')->check();
        $maxMonthlyValue = max(1, $chartData['months']->max('value'));
        $statusTotal = max(1, $chartData['status']->sum('value'));
        $chartColors = ['#246b5a', '#62a88e', '#e1ae52', '#df765f'];
        $statLinks = [
            'total_buku' => route('buku.index'),
            'total_anggota' => route('anggota.index'),
            'buku_tersedia' => route('buku.index'),
            'buku_dipinjam' => route('peminjaman.petugas.index'),
            'peminjaman_aktif' => route('peminjaman.petugas.index'),
            'terlambat' => route('peminjaman.petugas.index', ['status' => 'Terlambat']),
            'kunjungan_hari_ini' => route('kunjungan.index'),
        ];
        $offset = 0;
        $segments = $chartData['status']
            ->map(function ($item, $index) use (&$offset, $statusTotal, $chartColors) {
                $percent = round(($item['value'] / $statusTotal) * 100, 2);
                $segment = $chartColors[$index] . ' ' . $offset . '% ' . ($offset + $percent) . '%';

                $offset += $percent;

                return $segment;
            })
            ->implode(', ');
    @endphp

    <main class="app-page dashboard-page">
        <header class="dashboard-hero">
            <div>
                <p class="eyebrow">{{ now()->translatedFormat('l, d F Y') }}</p>
                <h1>Selamat datang, {{ strtok($user->nama, ' ') }}.</h1>
                <p>Berikut ringkasan aktivitas perpustakaan Anda hari ini.</p>
            </div>

            <div class="hero-actions">
                @if ($isPetugas)
                    <a class="button" href="{{ route('peminjaman.petugas.index') }}">Kelola peminjaman</a>
                    <a class="button button-secondary" href="{{ route('buku.create') }}">Tambah buku</a>
                @else
                    <a class="button" href="{{ route('katalog.index') }}">Cari buku</a>
                    <a class="button button-secondary" href="{{ route('peminjaman.create') }}">Ajukan pinjam</a>
                @endif
            </div>
        </header>

        @if (! $isPetugas && $unreadNotifications > 0)
            <a class="dashboard-alert" href="{{ route('notifikasi.index') }}">
                <span class="dashboard-alert-dot" aria-hidden="true"></span>
                <span>
                    <strong>{{ $unreadNotifications }} notifikasi belum dibaca</strong>
                    <small>Lihat informasi dan pengumuman terbaru.</small>
                </span>
                <span class="dashboard-alert-action">Lihat</span>
            </a>
        @endif

        <section class="dashboard-section" aria-labelledby="overview-title">
            <div class="dashboard-section-heading">
                <div>
                    <p class="eyebrow">Overview</p>
                    <h2 id="overview-title">Statistik utama</h2>
                </div>
            </div>

            <div class="dashboard-stats">
                @foreach ($stats as $label => $value)
                    @if ($isPetugas)
                        <a class="stat-card stat-card-link" href="{{ $statLinks[$label] }}">
                            <span>{{ ucwords(str_replace('_', ' ', $label)) }}</span>
                            <strong>{{ number_format($value, 0, ',', '.') }}</strong>
                        </a>
                    @else
                        <a class="stat-card stat-card-link" href="{{ $label === 'kunjungan' ? route('kunjungan.index') : route('peminjaman.index') }}">
                            <span>{{ ucwords(str_replace('_', ' ', $label)) }}</span>
                            <strong>{{ number_format($value, 0, ',', '.') }}</strong>
                        </a>
                    @endif
                @endforeach
            </div>
        </section>

        <section class="dashboard-charts" aria-label="Visualisasi statistik">
            <article class="content-card chart-card">
                <div class="chart-heading">
                    <div>
                        <p class="eyebrow">Tren</p>
                        <h2>Peminjaman 6 bulan terakhir</h2>
                    </div>
                    <span class="chart-caption">Jumlah transaksi</span>
                </div>

                <div class="bar-chart" role="img" aria-label="Diagram batang peminjaman enam bulan terakhir">
                    @foreach ($chartData['months'] as $month)
                        <a
                            class="bar-column"
                            href="{{ $isPetugas ? route('dashboard.petugas.statistik', ['jenis' => 'peminjaman_bulan', 'bulan' => $month['month']]) : route('peminjaman.index') }}"
                            aria-label="Lihat {{ $month['value'] }} peminjaman bulan {{ $month['label'] }}"
                        >
                            <span class="bar-value">{{ $month['value'] }}</span>
                            <span class="bar-track">
                                <span class="bar-fill" style="height: {{ max(5, ($month['value'] / $maxMonthlyValue) * 100) }}%"></span>
                            </span>
                            <span class="bar-label">{{ $month['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </article>

            <article class="content-card chart-card status-chart-card">
                <div class="chart-heading">
                    <div>
                        <p class="eyebrow">Status</p>
                        <h2>Komposisi peminjaman</h2>
                    </div>
                </div>

                <div class="donut-layout">
                    <div
                        class="donut-chart"
                        style="background: conic-gradient({{ $segments ?: '#e6eeeb 0 100%' }});"
                        role="img"
                        aria-label="Diagram donat status peminjaman"
                    >
                        <span>
                            <strong>{{ $chartData['status']->sum('value') }}</strong>
                            <small>Total</small>
                        </span>
                    </div>

                    <ul class="chart-legend">
                        @foreach ($chartData['status'] as $status)
                            <li>
                                <a href="{{ $isPetugas ? route('dashboard.petugas.statistik', ['jenis' => 'status_peminjaman', 'status' => $status['label']]) : route('peminjaman.index') }}">
                                    <i style="background: {{ $chartColors[$loop->index] }}"></i>
                                    <span>{{ $status['label'] }}</span>
                                    <strong>{{ $status['value'] }}</strong>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </article>
        </section>

        <section class="dashboard-lower">
            <article class="content-card activity-card">
                <div class="dashboard-section-heading">
                    <div>
                        <p class="eyebrow">Terbaru</p>
                        <h2>{{ $isPetugas ? 'Aktivitas peminjaman' : 'Peminjaman terbaru' }}</h2>
                    </div>
                    <a class="text-link" href="{{ $isPetugas ? route('peminjaman.petugas.index') : route('peminjaman.index') }}">Lihat semua</a>
                </div>

                <div class="activity-list">
                    @forelse ($aktivitas as $item)
                        <div class="activity-item">
                            <span class="activity-icon" aria-hidden="true">↗</span>
                            <div>
                                <strong>{{ $isPetugas ? $item->anggota->nama : ($item->detailPeminjaman->first()?->buku?->judul ?? 'Peminjaman buku') }}</strong>
                                <small>{{ $item->created_at?->translatedFormat('d M Y') ?? 'Baru saja' }}</small>
                            </div>
                            <span class="badge {{ $item->status === 'Terlambat' ? 'badge-warning' : ($item->status === 'Dikembalikan' ? 'badge-success' : 'badge-muted') }}">
                                {{ $item->status }}
                            </span>
                        </div>
                    @empty
                        <p class="empty-state">Belum ada aktivitas peminjaman.</p>
                    @endforelse
                </div>
            </article>

            <article class="content-card announcement-card">
                <div class="dashboard-section-heading">
                    <div>
                        <p class="eyebrow">Informasi</p>
                        <h2>Pengumuman</h2>
                    </div>
                    <a class="text-link" href="{{ route('pengumuman.index') }}">Semua</a>
                </div>

                <div class="announcement-list">
                    @forelse ($pengumuman as $item)
                        <article class="announcement-item">
                            <h3>{{ $item->judul }}</h3>
                            <p class="muted">{{ Str::limit($item->isi, 92) }}</p>
                        </article>
                    @empty
                        <p class="empty-state">Belum ada pengumuman aktif.</p>
                    @endforelse
                </div>
            </article>
        </section>
    </main>
@endsection
