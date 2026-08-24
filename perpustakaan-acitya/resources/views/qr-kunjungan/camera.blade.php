@extends('layouts.app')

@section('content')
    <main class="app-page scanner-page">
        <header class="page-header">
            <div>
                <p class="eyebrow">Kunjungan Digital</p>
                <h1>Scan QR Kunjungan</h1>
                <p class="muted">Arahkan kamera ke QR Code yang dibuat oleh petugas perpustakaan.</p>
            </div>
            <a class="button button-secondary" href="{{ route('kunjungan.index') }}">Kembali</a>
        </header>

        <section class="content-card scanner-card" data-qr-scanner data-scan-prefix="{{ url('/kunjungan/scan') }}/">
            <div class="scanner-preview">
                <video class="scanner-video" autoplay muted playsinline aria-label="Pratinjau kamera untuk scan QR"></video>
                <div class="scanner-frame" aria-hidden="true"></div>
                <p class="scanner-placeholder">Kamera belum dinyalakan</p>
            </div>
            <div class="scanner-controls">
                <p class="scanner-status" role="status">Tekan tombol untuk menyalakan kamera.</p>
                <button class="button scanner-start" type="button">Nyalakan kamera</button>
                <button class="link-button scanner-stop" type="button" hidden>Matikan kamera</button>
                <p class="table-note">Izinkan akses kamera ketika diminta. Pemindaian kamera memerlukan koneksi HTTPS atau localhost.</p>
            </div>

            <div class="scanner-manual">
                <p><strong>Tidak dapat memakai kamera?</strong> Tempel tautan dari QR Code di bawah ini.</p>
                <form class="filter-form scanner-manual-form" data-qr-manual-form>
                    <input type="url" name="qr_url" placeholder="https://.../kunjungan/scan/..." aria-label="Tautan QR kunjungan" required>
                    <button type="submit" class="button">Buka tautan</button>
                </form>
            </div>
        </section>
    </main>
@endsection
