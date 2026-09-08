<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Acitya Wiguna | SMKN 1 Rembang Purbalingga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="landing-body">
    <header class="landing-header">
        <nav class="landing-nav" aria-label="Navigasi utama">
            <a href="{{ route('landing') }}" class="landing-brand" aria-label="Beranda Perpustakaan Acitya Wiguna">
                <img src="{{ asset('images/logoperpus.png') }}" alt="Logo Perpustakaan Acitya Wiguna SMKN 1 Rembang" class="landing-logo">
                <span>Perpustakaan <strong>Acitya Wiguna</strong></span>
            </a>
            <button class="landing-menu-toggle" type="button" aria-label="Buka menu navigasi" aria-controls="landing-menu" aria-expanded="false" data-landing-menu-toggle><span></span><span></span><span></span></button>
            <div class="landing-menu" id="landing-menu" data-landing-menu>
                <a href="#beranda">Beranda</a><a href="{{ route('katalog.index') }}">Katalog</a><a href="#tentang">Tentang</a><a href="#layanan">Layanan</a><a href="#koleksi">Koleksi</a><a href="#peraturan">Peraturan</a>
                <a href="{{ route('login') }}" class="landing-login">Login</a>
            </div>
        </nav>
    </header>

    <main id="beranda">
        <section class="landing-hero">
            <div class="landing-hero-copy">
                <p class="landing-kicker">SMKN 1 Rembang Purbalingga</p>
                <h1>Perpustakaan<br><em>Acitya Wiguna</em></h1>
                <p>Temukan berbagai koleksi buku dan manfaatkan layanan perpustakaan untuk mendukung kegiatan belajar dan menambah wawasan.</p>
                <div class="landing-actions"><a href="{{ route('katalog.index') }}" class="landing-primary">Lihat Katalog <span aria-hidden="true">→</span></a><a href="{{ route('login') }}" class="landing-secondary">Login</a></div>
            </div>
            <div class="landing-hero-logo-wrap"><img src="{{ asset('images/logoperpus.png') }}" alt="Logo Perpustakaan Acitya Wiguna SMKN 1 Rembang" class="landing-hero-logo"></div>
        </section>

        <section class="landing-section landing-about" id="tentang">
            <div><p class="landing-kicker">Tentang Perpustakaan</p><h2>Ruang belajar dan literasi untuk warga sekolah.</h2></div>
            <div><p><strong>Perpustakaan Acitya Wiguna</strong> merupakan perpustakaan SMKN 1 Rembang Purbalingga yang mendukung kegiatan membaca, belajar, dan pencarian informasi bagi siswa, guru, serta karyawan.</p><a href="#layanan" class="landing-text-link">Kenali layanan kami <span aria-hidden="true">→</span></a></div>
        </section>

        <section class="landing-vision" aria-labelledby="visi-misi-title">
            <div class="landing-vision-heading"><p class="landing-kicker">Arah kami</p><h2 id="visi-misi-title">Visi &amp; Misi</h2></div>
            <article class="vision-card"><p>Visi</p><h3>“Menjadikan perpustakaan mini di masa sekolah, demi terwujudnya Generasi yang cerdas, mandiri dan berwawasan luas.”</h3></article>
            <div class="mission-list">
                <article><b>01</b><p>Memberikan layanan yang ramah, mudah, dan bersahabat.</p></article>
                <article><b>02</b><p>Menyediakan sumber bacaan yang lengkap demi terpenuhinya kebutuhan informasi masyarakat.</p></article>
                <article><b>03</b><p>Menyelenggarakan kegiatan peningkatan minat baca di lingkungan sekolah.</p></article>
                <article><b>04</b><p>Menyediakan sarana prasarana pendidikan demi terciptanya perpustakaan yang nyaman, sehingga menarik para pemustaka untuk berkunjung.</p></article>
            </div>
        </section>

        <section class="landing-block" id="layanan"><div class="landing-block-heading"><p class="landing-kicker">Apa yang tersedia</p><h2>Jenis Layanan</h2><p>Layanan yang mendukung proses belajar, membaca, dan mencari informasi.</p></div>
            <div class="service-grid">
                <article><i aria-hidden="true">↗</i><h3>Layanan Sirkulasi</h3><p>Layanan peminjaman dan pengembalian buku serta layanan perpanjangan peminjaman buku.</p></article>
                <article><i aria-hidden="true">⌕</i><h3>Layanan Referensi</h3><p>Pemanfaatan ensiklopedia, kamus, atlas, laporan penelitian, laporan kegiatan industri, dan koleksi referensi lainnya.</p></article>
                <article><i aria-hidden="true">▤</i><h3>Layanan Serial</h3><p>Pemanfaatan koleksi terbitan berseri seperti koran, majalah, tabloid, dan lain-lain.</p></article>
                <article><i aria-hidden="true">✦</i><h3>Layanan Belajar Mengajar</h3><p>Kegiatan belajar mengajar dapat dilaksanakan di ruang perpustakaan.</p></article>
                <article><i aria-hidden="true">▣</i><h3>Layanan Komputer</h3><p>Siswa dapat memanfaatkan komputer untuk mencari informasi dan mengerjakan tugas.</p></article>
            </div>
        </section>

        <section class="landing-books" id="koleksi"><div class="landing-block-heading"><p class="landing-kicker">Bacaan pilihan</p><h2>Jelajahi Koleksi Buku</h2><p>Jelajahi koleksi yang tersedia melalui katalog perpustakaan.</p></div>
            @if (isset($bukuPilihan) && $bukuPilihan->isNotEmpty())
                <div class="landing-book-grid">@foreach ($bukuPilihan as $buku)<article class="landing-book-card"><img src="{{ $buku->coverUrl() }}" alt="Cover {{ $buku->judul }}"><div><p>{{ $buku->kategori?->nama_kategori ?? 'Koleksi perpustakaan' }}</p><h3>{{ $buku->judul }}</h3><span>{{ $buku->penulis ?: 'Penulis tidak dicantumkan' }}</span></div></article>@endforeach</div>
            @else
                <div class="landing-empty-books"><span aria-hidden="true">▤</span><p>Koleksi buku dapat dilihat melalui katalog perpustakaan.</p></div>
            @endif
            <a href="{{ route('katalog.index') }}" class="landing-secondary landing-collection-link">Lihat Semua Koleksi <span aria-hidden="true">→</span></a>
        </section>

        <section class="landing-rules" id="peraturan"><div class="landing-block-heading"><p class="landing-kicker">Nyaman untuk semua</p><h2>Peraturan Perpustakaan</h2><p>Mohon perhatikan tata tertib berikut saat menggunakan layanan perpustakaan.</p></div>
            <div class="rules-grid"><article><h3>Tata Tertib</h3><ol><li>Wajib lapor kepada pustakawan dan mengisi buku kunjungan.</li><li>Menjaga keamanan dan ketertiban di perpustakaan.</li><li>Memiliki kartu anggota/peminjaman saat meminjam buku.</li><li>Diperkenankan mengakses semua koleksi yang tersedia.</li><li>Maksimal meminjam 3 buku dalam 1 minggu.</li><li>Koleksi referensi hanya dibaca di perpustakaan.</li><li>Menjaga koleksi yang dipinjam dan mengganti jika hilang.</li><li>Menaati tata tertib yang berlaku.</li></ol></article><article class="rules-warning"><h3>Larangan</h3><ul><li>Tidak memakai jaket, topi, dan membawa tas ke ruang perpustakaan.</li><li>Tidak makan dan minum di perpustakaan.</li><li>Tidak mencoret, menggunting, atau menyobek koleksi.</li></ul></article></div>
        </section>

        <section class="landing-info"><div><p class="landing-kicker">Informasi Perpustakaan</p><h2>Datang, membaca, dan belajar bersama.</h2><p><strong>Perpustakaan Acitya Wiguna</strong><br>SMKN 1 Rembang Purbalingga</p></div><article><span>Jam Layanan</span><h3>Senin – Kamis</h3><p>07.00 – 15.30</p><h3>Jumat</h3><p>07.00 – 14.00</p></article></section>

        <section class="landing-cta"><div><p class="landing-kicker">Mulai sekarang</p><h2>Temukan buku, pengetahuan, dan informasi yang kamu butuhkan.</h2><p>Jelajahi koleksi Perpustakaan Acitya Wiguna dan manfaatkan layanan yang tersedia.</p></div><a href="{{ route('katalog.index') }}" class="landing-primary">Lihat Katalog <span aria-hidden="true">→</span></a></section>
    </main>
    <footer class="landing-footer"><div class="landing-footer-inner"><div class="landing-footer-brand"><img src="{{ asset('images/logoperpus.png') }}" alt="Logo Perpustakaan Acitya Wiguna"><span>Perpustakaan <strong>Acitya Wiguna</strong><small>SMKN 1 Rembang Purbalingga</small></span></div><nav aria-label="Tautan footer"><a href="#tentang">Tentang</a><a href="#layanan">Layanan</a><a href="#koleksi">Koleksi</a><a href="{{ route('login') }}">Login</a></nav></div><p>© {{ date('Y') }} Perpustakaan Acitya Wiguna</p></footer>
</body>
</html>
