# PRODUCT REQUIREMENTS DOCUMENT (PRD)

# Sistem Informasi Perpustakaan Acitya Wiguna

### SMK Negeri 1 Rembang Purbalingga

**Versi Dokumen:** 1.0
**Status:** Draft
**Tanggal:** Juli 2026
**Jenis Dokumen:** Product Requirements Document (PRD)

---

# BAB I

# Product Overview

---

# 1.1 Informasi Produk

| Informasi                     | Keterangan                                                  |
| ----------------------------- | ----------------------------------------------------------- |
| **Nama Produk**         | Sistem Informasi Perpustakaan Acitya Wiguna                 |
| **Jenis Produk**        | Responsive Web Application                                  |
| **Platform**            | Web Browser (Desktop, Laptop, Tablet, Smartphone)           |
| **Target Pengguna**     | Petugas Perpustakaan, Siswa, Guru, Karyawan                 |
| **Lokasi Implementasi** | Perpustakaan Acitya Wiguna SMK Negeri 1 Rembang Purbalingga |
| **Bahasa Sistem**       | Bahasa Indonesia                                            |
| **Database**            | MySQL                                                       |
| **Framework Backend**   | Laravel                                                     |
| **Framework Frontend**  | Bootstrap / Tailwind CSS                                    |
| **Status Produk**       | Pengembangan (Development)                                  |

---

# 1.2 Deskripsi Produk

Sistem Informasi Perpustakaan Acitya Wiguna merupakan aplikasi berbasis web yang dirancang untuk membantu proses pengelolaan perpustakaan di SMK Negeri 1 Rembang Purbalingga. Sistem ini dikembangkan sebagai solusi digital untuk meningkatkan efektivitas dan efisiensi dalam pengelolaan data buku, data anggota, kunjungan perpustakaan, peminjaman, pengembalian, hingga pembuatan laporan.

Aplikasi dirancang menggunakan konsep **Responsive Web Application**, sehingga dapat diakses melalui berbagai perangkat seperti komputer, laptop, tablet, maupun smartphone tanpa memerlukan proses instalasi. Selain itu, sistem juga dioptimalkan agar tetap ringan sehingga dapat berjalan dengan baik pada komputer perpustakaan yang memiliki spesifikasi terbatas.

Sistem ini menerapkan konsep **Role-Based Access Control (RBAC)**, yaitu setiap pengguna memiliki hak akses yang berbeda sesuai perannya, sehingga keamanan data dan kemudahan penggunaan dapat tetap terjaga.

---

# 1.3 Latar Belakang

Perpustakaan merupakan salah satu fasilitas penting dalam mendukung kegiatan belajar mengajar di lingkungan sekolah. Selain menjadi tempat penyimpanan koleksi buku, perpustakaan juga berperan sebagai pusat informasi, sumber belajar, serta sarana untuk meningkatkan budaya literasi di kalangan siswa.

Berdasarkan hasil observasi yang dilakukan di Perpustakaan Acitya Wiguna SMK Negeri 1 Rembang Purbalingga, masih ditemukan beberapa kendala dalam proses pengelolaan perpustakaan. Pendataan buku dan anggota belum sepenuhnya terdigitalisasi, pencatatan kunjungan masih menggunakan buku kunjungan manual, serta proses peminjaman dan pengembalian masih memerlukan pengelolaan yang lebih efisien.

Selain itu, petugas perpustakaan hanya berjumlah satu orang sehingga diperlukan sistem yang mampu membantu proses administrasi tanpa menambah beban kerja petugas. Perangkat komputer yang digunakan di perpustakaan juga memiliki spesifikasi yang terbatas sehingga aplikasi harus dirancang ringan namun tetap memiliki fitur yang lengkap.

Berdasarkan kondisi tersebut, dirancanglah Sistem Informasi Perpustakaan Acitya Wiguna berbasis web yang responsif, ringan, dan mudah digunakan. Sistem ini diharapkan mampu mendukung digitalisasi perpustakaan, meningkatkan kualitas pelayanan, mempermudah pengelolaan data, serta memberikan pengalaman yang lebih baik bagi petugas, siswa, guru, maupun karyawan.

---

# 1.4 Tujuan Produk

Pengembangan Sistem Informasi Perpustakaan Acitya Wiguna bertujuan untuk:

1. Membantu proses digitalisasi perpustakaan sehingga pengelolaan data menjadi lebih efektif.
2. Mempermudah petugas dalam mengelola data buku, kategori buku, dan anggota perpustakaan.
3. Mempermudah proses peminjaman dan pengembalian buku melalui sistem yang terstruktur.
4. Menampilkan informasi ketersediaan stok buku secara **real-time**.
5. Menggantikan buku kunjungan manual dengan sistem kunjungan digital.
6. Menyediakan laporan perpustakaan secara otomatis dan lebih akurat.
7. Menyediakan sistem backup database untuk mengurangi risiko kehilangan data.
8. Meningkatkan minat baca melalui fitur **Achievement** dan **Leaderboard**.
9. Membangun sistem yang ringan, responsif, aman, dan mudah digunakan pada berbagai perangkat.

---

# 1.5 Ruang Lingkup Produk

Sistem yang dikembangkan hanya digunakan di lingkungan Perpustakaan Acitya Wiguna SMK Negeri 1 Rembang Purbalingga.

Ruang lingkup sistem meliputi:

* Pengelolaan data buku.
* Pengelolaan kategori buku.
* Pengelolaan anggota perpustakaan.
* Digitalisasi buku kunjungan.
* Peminjaman buku.
* Pengembalian buku.
* Pengelolaan buku hilang melalui sistem penggantian buku.
* Riwayat peminjaman.
* Achievement pengguna.
* Leaderboard pengguna.
* Pengumuman perpustakaan.
* Pembuatan laporan.
* Backup database.
* Manajemen status anggota aktif dan alumni.

---

# 1.6 Target Pengguna

Sistem ini dirancang untuk digunakan oleh tiga jenis pengguna utama.

### 1. Petugas Perpustakaan

Petugas bertanggung jawab dalam mengelola seluruh data perpustakaan, memverifikasi transaksi peminjaman dan pengembalian, mengelola kunjungan, membuat laporan, serta memantau aktivitas pengguna.

### 2. Siswa

Siswa dapat mencari koleksi buku, mengajukan peminjaman, melihat riwayat peminjaman, melihat riwayat kunjungan, memperoleh achievement, serta melihat leaderboard.

### 3. Guru dan Karyawan

Guru dan karyawan dapat mencari buku, mengajukan peminjaman, melihat riwayat transaksi, serta memperoleh informasi mengenai koleksi perpustakaan.

---

# 1.7 Permasalahan yang Ingin Diselesaikan

Berdasarkan hasil observasi, beberapa permasalahan utama yang ingin diselesaikan melalui sistem ini adalah:

| No | Permasalahan                                            | Solusi Sistem                          |
| -- | ------------------------------------------------------- | -------------------------------------- |
| 1  | Pendataan perpustakaan belum sepenuhnya terdigitalisasi | Digitalisasi seluruh data perpustakaan |
| 2  | Buku kunjungan masih menggunakan media tulis            | Buku Kunjungan Digital                 |
| 3  | Petugas perpustakaan hanya satu orang                   | Otomatisasi proses administrasi        |
| 4  | Sulit mengetahui stok buku yang tersedia                | Informasi stok buku secara real-time   |
| 5  | Sulit memantau aktivitas peminjaman                     | Dashboard dan riwayat transaksi        |
| 6  | Belum tersedia backup database                          | Fitur backup dan restore database      |
| 7  | Belum terdapat media untuk meningkatkan minat baca      | Achievement dan Leaderboard            |
| 8  | Data anggota terus bertambah setiap tahun               | Status alumni otomatis                 |

---

# 1.8 Visi Produk

Membangun sistem informasi perpustakaan yang modern, ringan, responsif, dan mudah digunakan untuk mendukung digitalisasi perpustakaan serta meningkatkan kualitas pelayanan dan budaya literasi di lingkungan SMK Negeri 1 Rembang Purbalingga.

---

# 1.9 Misi Produk

* Mempermudah pengelolaan administrasi perpustakaan.
* Menyediakan informasi buku secara cepat dan akurat.
* Mengurangi proses pencatatan manual.
* Meningkatkan efisiensi kerja petugas perpustakaan.
* Memberikan pengalaman penggunaan yang mudah bagi seluruh pengguna.
* Mendukung peningkatan budaya literasi melalui fitur-fitur interaktif.

---

# BAB II

# Business & User Requirements

---

# 2.1 Business Requirement

Sistem Informasi Perpustakaan Acitya Wiguna dikembangkan untuk memenuhi kebutuhan operasional perpustakaan di SMK Negeri 1 Rembang Purbalingga agar proses administrasi menjadi lebih efektif, efisien, dan terdigitalisasi.

Sistem diharapkan mampu membantu petugas perpustakaan dalam mengelola seluruh aktivitas perpustakaan mulai dari pendataan buku, pendataan anggota, pencatatan kunjungan, transaksi peminjaman dan pengembalian, hingga pembuatan laporan secara otomatis.

Selain membantu petugas, sistem juga memberikan kemudahan bagi siswa, guru, dan karyawan dalam mencari informasi buku, mengajukan peminjaman, melihat riwayat transaksi, serta memperoleh informasi terbaru mengenai perpustakaan.

---

## Business Goals

Pengembangan sistem memiliki beberapa tujuan bisnis sebagai berikut:

* Meningkatkan efisiensi pelayanan perpustakaan.
* Mengurangi proses administrasi manual.
* Mempermudah pengelolaan data perpustakaan.
* Mengurangi risiko kehilangan data melalui sistem backup.
* Menyediakan informasi perpustakaan secara real-time.
* Meningkatkan minat baca melalui fitur digital.
* Mendukung digitalisasi perpustakaan sekolah.

---

# 2.2 Stakeholder

Pihak-pihak yang terlibat dalam sistem antara lain:

| Stakeholder          | Peran                               |
| -------------------- | ----------------------------------- |
| Kepala Sekolah       | Menyetujui penggunaan sistem        |
| Petugas Perpustakaan | Mengelola seluruh data perpustakaan |
| Siswa                | Menggunakan layanan perpustakaan    |
| Guru                 | Menggunakan layanan perpustakaan    |
| Karyawan             | Menggunakan layanan perpustakaan    |
| Tim Pengembang       | Mengembangkan dan memelihara sistem |

---

# 2.3 User Persona

## A. Petugas Perpustakaan

### Profil

* Pengguna utama sistem.
* Mengelola seluruh aktivitas perpustakaan.
* Login menggunakan NIP.

### Tujuan

* Mengelola data buku.
* Mengelola anggota.
* Mengelola kunjungan.
* Mengelola peminjaman.
* Mengelola pengembalian.
* Membuat laporan.

### Kendala

* Jumlah petugas hanya satu orang.
* Pendataan masih dilakukan secara manual.
* Membutuhkan sistem yang ringan dan mudah digunakan.

### Kebutuhan

* Dashboard yang informatif.
* Proses pengelolaan data yang cepat.
* Sistem otomatis untuk mengurangi pekerjaan berulang.
* Laporan yang dapat dibuat dengan mudah.

---

## B. Siswa

### Profil

* Anggota perpustakaan.
* Login menggunakan NIS/NISN.

### Tujuan

* Mencari buku.
* Meminjam buku.
* Mengembalikan buku.
* Membaca buku di perpustakaan.
* Melihat riwayat peminjaman.
* Mendapatkan achievement.

### Kendala

* Sulit mengetahui stok buku.
* Harus melihat buku secara langsung di perpustakaan.
* Sulit mengingat tanggal pengembalian.

### Kebutuhan

* Informasi stok buku.
* Riwayat peminjaman.
* Notifikasi pengembalian.
* Achievement dan leaderboard.

---

## C. Guru / Karyawan

### Profil

* Anggota perpustakaan.
* Login menggunakan NIP.

### Tujuan

* Meminjam buku.
* Mencari koleksi buku.

### Kendala

* Sulit mengetahui ketersediaan buku.

### Kebutuhan

* Sistem yang sederhana.
* Informasi stok secara real-time.
* Riwayat peminjaman.

---

# 2.4 Hak Akses Pengguna

Sistem menggunakan **Role-Based Access Control (RBAC)**, yaitu setiap pengguna hanya dapat mengakses fitur sesuai dengan perannya.

---

## Petugas Perpustakaan

Login menggunakan **NIP**.

Hak akses:

* Dashboard
* Manajemen Buku
* Manajemen Kategori
* Manajemen Anggota
* Buku Kunjungan Digital
* Konfirmasi Peminjaman
* Konfirmasi Pengembalian
* Kelola Buku Hilang
* Achievement Monitoring
* Leaderboard Monitoring
* Laporan
* Pengumuman
* Backup Database
* Pengaturan Sistem

---

## Siswa

Login menggunakan **NIS/NISN**.

Hak akses:

* Dashboard
* Profil
* Katalog Buku
* Detail Buku
* Ajukan Peminjaman
* Riwayat Peminjaman
* Riwayat Kunjungan
* Achievement
* Leaderboard
* Pengumuman
* Notifikasi

---

## Guru / Karyawan

Login menggunakan **NIP**.

Hak akses:

* Dashboard
* Profil
* Katalog Buku
* Detail Buku
* Ajukan Peminjaman
* Riwayat Peminjaman
* Riwayat Kunjungan
* Pengumuman
* Notifikasi

---

# 2.5 User Journey

## Petugas

```text
Login
   │
   ▼
Dashboard
   │
   ├── Kelola Buku
   ├── Kelola Anggota
   ├── Kelola Kunjungan
   ├── Konfirmasi Peminjaman
   ├── Konfirmasi Pengembalian
   ├── Kelola Buku Hilang
   ├── Achievement Monitoring
   ├── Laporan
   └── Backup Database
```

---

## Siswa

```text
Login
   │
   ▼
Dashboard
   │
   ├── Cari Buku
   ├── Lihat Detail Buku
   ├── Ajukan Peminjaman
   ├── Lihat Riwayat
   ├── Isi Buku Kunjungan
   ├── Achievement
   ├── Leaderboard
   └── Pengumuman
```

---

## Guru / Karyawan

```text
Login
   │
   ▼
Dashboard
   │
   ├── Cari Buku
   ├── Detail Buku
   ├── Ajukan Peminjaman
   ├── Riwayat
   ├── Isi Buku Kunjungan
   └── Pengumuman
```

---

# 2.6 Kebutuhan Pengguna

| Fitur                   |  Petugas  | Siswa | Guru/Karyawan |
| ----------------------- | :--------: | :---: | :-----------: |
| Login                   |     ✓     |  ✓  |      ✓      |
| Dashboard               |     ✓     |  ✓  |      ✓      |
| Kelola Buku             |     ✓     |  –  |      –      |
| Kelola Kategori         |     ✓     |  –  |      –      |
| Kelola Anggota          |     ✓     |  –  |      –      |
| Buku Kunjungan Digital  | Monitoring |  ✓  |      ✓      |
| Cari Buku               |     ✓     |  ✓  |      ✓      |
| Ajukan Peminjaman       |     –     |  ✓  |      ✓      |
| Konfirmasi Peminjaman   |     ✓     |  –  |      –      |
| Konfirmasi Pengembalian |     ✓     |  –  |      –      |
| Riwayat Peminjaman      |     ✓     |  ✓  |      ✓      |
| Riwayat Kunjungan       |     ✓     |  ✓  |      ✓      |
| Achievement             | Monitoring |  ✓  |      ✓      |
| Leaderboard             | Monitoring |  ✓  |      ✓      |
| Pengumuman              |     ✓     |  ✓  |      ✓      |
| Laporan                 |     ✓     |  –  |      –      |
| Backup Database         |     ✓     |  –  |      –      |

**Keterangan:**

* **✓** : Fitur dapat diakses atau digunakan oleh pengguna.
* **–** : Fitur tidak dapat diakses oleh pengguna.
* **Monitoring** : Petugas hanya dapat melihat, memantau, dan mengelola data terkait tanpa ikut berpartisipasi sebagai pengguna fitur.

---

# 2.7 Business Rules

Untuk memastikan sistem berjalan sesuai kebijakan perpustakaan, ditetapkan aturan sebagai berikut:

* Login menggunakan identitas resmi sekolah (NIP atau NIS/NISN).
* Siswa maksimal meminjam **3 buku** selama **7 hari**.
* Buku paket memiliki aturan peminjaman khusus dan tidak mengikuti batas maksimal 3 buku.
* Perpanjangan masa pinjam dilakukan sesuai kebijakan petugas.
* Buku yang hilang tidak dikenakan denda uang, tetapi wajib diganti dengan buku yang sama atau setara.
* Setelah buku pengganti diterima, transaksi dinyatakan selesai.
* Seluruh kunjungan perpustakaan dicatat melalui Buku Kunjungan Digital.
* Achievement diberikan secara otomatis oleh sistem berdasarkan aktivitas pengguna.
* Leaderboard dihitung berdasarkan aktivitas membaca, peminjaman, dan kunjungan.
* Status siswa berubah menjadi **Alumni** setelah masa belajar berakhir sehingga tidak dapat melakukan peminjaman baru, tetapi riwayat tetap tersimpan sebagai arsip.

---

# BAB III

# Feature Requirements

Bab ini menjelaskan seluruh kebutuhan fungsional Sistem Informasi Perpustakaan Acitya Wiguna. Setiap fitur dijelaskan berdasarkan tujuan, hak akses pengguna, alur sistem, aturan bisnis, validasi, manfaat, serta pengembangan di masa mendatang.

---

# FR-001 Login Multi User

## Deskripsi

Fitur Login merupakan gerbang utama untuk mengakses Sistem Informasi Perpustakaan Acitya Wiguna. Sistem menerapkan **Role-Based Access Control (RBAC)** sehingga setiap pengguna hanya dapat mengakses fitur sesuai dengan hak aksesnya.

Autentikasi menggunakan identitas resmi sekolah sehingga pengguna tidak perlu membuat akun baru.

Jenis pengguna terdiri dari:

* Petugas Perpustakaan
* Siswa
* Guru/Karyawan

---

## Tujuan

* Menjaga keamanan sistem.
* Membatasi hak akses sesuai peran pengguna.
* Mempermudah proses autentikasi.
* Mengurangi pengelolaan akun secara manual.

---

## Hak Akses

### Petugas

Login menggunakan NIP.

Setelah berhasil login, pengguna diarahkan ke Dashboard Petugas.

### Siswa

Login menggunakan NIS/NISN.

Setelah berhasil login, pengguna diarahkan ke Dashboard Siswa.

### Guru/Karyawan

Login menggunakan NIP.

Setelah berhasil login, pengguna diarahkan ke Dashboard Guru/Karyawan.

---

## Alur Sistem

```text
Pengguna membuka website
        │
        ▼
Klik Login
        │
        ▼
Memilih Role
        │
        ▼
Mengisi NIP / NIS-NISN
        │
        ▼
Sistem memverifikasi data
        │
     Data Valid?
      │      │
     Ya    Tidak
      │      │
      ▼      ▼
 Dashboard  Pesan Kesalahan
```

---

## Business Rules

* Login menggunakan identitas resmi sekolah.
* Hak akses ditentukan berdasarkan role pengguna.
* Pengguna hanya dapat mengakses menu sesuai hak aksesnya.
* Akun Alumni tidak dapat melakukan transaksi peminjaman.

---

## Validasi

Apabila identitas tidak ditemukan, sistem menampilkan pesan:

> NIP atau NIS/NISN tidak ditemukan.

Apabila akun telah berstatus Alumni, sistem menampilkan pesan:

> Status akun Anda adalah Alumni sehingga tidak dapat melakukan peminjaman.

---

## Manfaat

### Bagi Petugas

* Mempermudah pengelolaan akun.
* Mengurangi kesalahan autentikasi.

### Bagi Pengguna

* Login lebih cepat.
* Tidak perlu membuat akun baru.

---

## Future Development

* Login menggunakan QR Code.
* Integrasi dengan Single Sign-On (SSO).
* Two-Factor Authentication (2FA).

---

# FR-002 Landing Page

## Deskripsi

Landing Page merupakan halaman utama yang dapat diakses oleh seluruh pengunjung tanpa harus login. Halaman ini berfungsi sebagai media informasi resmi Perpustakaan Acitya Wiguna sekaligus menjadi pintu masuk menuju sistem.

Landing Page dirancang sederhana, responsif, dan mudah dipahami sehingga dapat diakses melalui komputer maupun perangkat seluler.

---

## Tujuan

* Menyediakan informasi mengenai perpustakaan.
* Memudahkan pengguna mencari informasi buku.
* Menjadi halaman awal sebelum login.
* Memperkenalkan layanan perpustakaan kepada seluruh warga sekolah.

---

## Struktur Halaman

Landing Page terdiri dari beberapa menu berikut.

### Beranda

Menampilkan informasi singkat mengenai perpustakaan, berita terbaru, serta tombol menuju katalog buku dan halaman login.

### Profil Perpustakaan

Menampilkan sejarah singkat, profil, dan informasi umum mengenai Perpustakaan Acitya Wiguna.

### Visi dan Misi

Menampilkan visi dan misi perpustakaan dalam mendukung budaya literasi di lingkungan sekolah.

### Jam Operasional

Menampilkan jadwal pelayanan perpustakaan.

### Tata Tertib

Menampilkan aturan yang berlaku selama menggunakan layanan perpustakaan.

### Katalog Buku

Menampilkan daftar koleksi buku yang tersedia beserta informasi stok secara real-time.

### Login

Mengarahkan pengguna menuju halaman autentikasi.

---

## Alur Sistem

```text
Pengunjung membuka website
        │
        ▼
Landing Page
        │
        ├── Beranda
        ├── Profil
        ├── Visi dan Misi
        ├── Jam Operasional
        ├── Tata Tertib
        ├── Katalog Buku
        └── Login
```

---

## Business Rules

* Landing Page dapat diakses tanpa login.
* Informasi hanya dapat diubah oleh petugas.
* Katalog hanya menampilkan informasi buku.
* Transaksi peminjaman hanya dapat dilakukan setelah login.

---

## Manfaat

### Bagi Pengunjung

* Memperoleh informasi perpustakaan secara mudah.
* Mengetahui ketersediaan buku sebelum datang ke perpustakaan.

### Bagi Perpustakaan

* Menjadi media informasi resmi.
* Mempermudah penyampaian pengumuman.

---

## Future Development

* Banner buku terbaru.
* Buku rekomendasi.
* Statistik koleksi perpustakaan.
* Agenda kegiatan literasi.
* Pencarian buku yang lebih lengkap.

---

# FR-003 Dashboard

## Deskripsi

Dashboard merupakan halaman utama setelah pengguna berhasil login. Dashboard menampilkan informasi sesuai dengan role pengguna sehingga setiap pengguna memperoleh informasi yang relevan dengan kebutuhannya.

Dashboard dibedakan menjadi tiga jenis, yaitu Dashboard Petugas, Dashboard Siswa, dan Dashboard Guru/Karyawan.

---

## Tujuan

* Menyajikan informasi penting secara ringkas.
* Mempermudah akses ke fitur utama.
* Menampilkan statistik dan aktivitas pengguna.
* Mempermudah proses pengelolaan perpustakaan.

---

## Dashboard Petugas

Dashboard Petugas berfungsi sebagai pusat pengelolaan seluruh aktivitas perpustakaan.

### Informasi yang Ditampilkan

* Total koleksi buku.
* Jumlah anggota.
* Jumlah kunjungan hari ini.
* Jumlah buku yang sedang dipinjam.
* Jumlah buku yang terlambat dikembalikan.
* Jumlah penggantian buku yang masih diproses.
* Achievement Statistics.
* Top Reader bulan berjalan.
* Pengumuman terbaru.
* Grafik peminjaman buku.
* Grafik kunjungan perpustakaan.

### Menu Cepat

* Kelola Buku
* Kelola Kategori
* Kelola Anggota
* Buku Kunjungan
* Peminjaman
* Pengembalian
* Buku Hilang
* Achievement Monitoring
* Leaderboard
* Laporan
* Backup Database

---

## Dashboard Siswa

Dashboard Siswa menampilkan informasi yang berkaitan dengan aktivitas perpustakaan milik siswa.

### Informasi yang Ditampilkan

* Profil pengguna.
* Jumlah buku yang sedang dipinjam.
* Sisa kuota peminjaman.
* Jadwal pengembalian berikutnya.
* Riwayat kunjungan.
* Riwayat peminjaman.
* Achievement yang telah diperoleh.
* Progress achievement berikutnya.
* Peringkat pada leaderboard.
* Pengumuman terbaru.
* Rekomendasi buku.

### Menu Cepat

* Cari Buku
* Ajukan Peminjaman
* Riwayat Peminjaman
* Buku Kunjungan
* Achievement
* Leaderboard
* Profil

---

## Dashboard Guru/Karyawan

Dashboard Guru/Karyawan memiliki fungsi yang sama dengan Dashboard Siswa, tetapi disesuaikan dengan data pengguna.

### Informasi yang Ditampilkan

* Profil pengguna.
* Jumlah buku yang sedang dipinjam.
* Riwayat peminjaman.
* Riwayat kunjungan.
* Achievement.
* Leaderboard.
* Pengumuman.
* Rekomendasi buku.

### Menu Cepat

* Cari Buku
* Ajukan Peminjaman
* Riwayat Peminjaman
* Buku Kunjungan
* Achievement
* Leaderboard
* Profil

---

## Business Rules

* Dashboard hanya dapat diakses setelah login.
* Informasi ditampilkan sesuai role pengguna.
* Statistik diperbarui secara otomatis berdasarkan aktivitas terbaru.
* Achievement dan leaderboard dihitung secara otomatis oleh sistem.
* Notifikasi ditampilkan apabila terdapat peminjaman yang mendekati jatuh tempo atau permohonan yang memerlukan tindak lanjut.

---

## Manfaat

### Bagi Petugas

* Mempermudah pemantauan kondisi perpustakaan.
* Mempercepat akses ke menu pengelolaan.

### Bagi Pengguna

* Mengetahui status peminjaman secara cepat.
* Melihat perkembangan aktivitas membaca.
* Memperoleh informasi terbaru tanpa harus membuka banyak halaman.

---

## Future Development

* Dashboard yang dapat dikustomisasi.
* Grafik statistik yang lebih interaktif.
* Widget favorit pengguna.
* Kalender kegiatan perpustakaan.
* Integrasi dengan sistem akademik sekolah.

---

# FR-004 Manajemen Buku

## Deskripsi

Manajemen Buku merupakan fitur yang digunakan oleh Petugas Perpustakaan untuk mengelola seluruh data koleksi buku. Melalui fitur ini, petugas dapat menambahkan buku baru, memperbarui informasi buku, menghapus data buku, mengelola stok, serta mengatur lokasi penyimpanan buku.

Seluruh perubahan data buku akan langsung diperbarui pada katalog sehingga informasi yang diterima pengguna selalu akurat dan terbaru.

---

## Tujuan

* Mempermudah pengelolaan koleksi buku.
* Menyediakan informasi buku yang akurat.
* Mengelola stok buku secara real-time.
* Mempermudah pencarian buku berdasarkan kategori.
* Mendukung proses peminjaman dan pengembalian.

---

## Hak Akses

| Role          | Hak Akses                         |
| ------------- | --------------------------------- |
| Petugas       | Mengelola seluruh data buku       |
| Siswa         | Melihat data buku melalui katalog |
| Guru/Karyawan | Melihat data buku melalui katalog |

---

## Data Buku

Setiap buku memiliki informasi sebagai berikut:

* Kode Buku
* ISBN (opsional)
* Judul Buku
* Penulis
* Penerbit
* Tahun Terbit
* Kategori
* Klasifikasi DDC (000–900)
* Lokasi Rak
* Jumlah Stok
* Stok Tersedia
* Stok Dipinjam
* Deskripsi Buku
* Cover Buku
* Status Buku (Tersedia / Habis / Tidak Aktif)

---

## Fitur Manajemen Buku

Petugas dapat melakukan beberapa aktivitas berikut:

### Menambahkan Buku

Petugas dapat menambahkan koleksi buku baru dengan mengisi seluruh informasi yang diperlukan.

### Mengubah Data Buku

Petugas dapat memperbarui informasi buku apabila terdapat perubahan data, seperti perubahan lokasi rak, jumlah stok, atau informasi lainnya.

### Menghapus Buku

Petugas dapat menghapus data buku yang sudah tidak menjadi koleksi perpustakaan.

### Mengelola Stok Buku

Jumlah stok akan berubah secara otomatis berdasarkan transaksi peminjaman, pengembalian, maupun penggantian buku yang hilang.

### Mengunggah Cover Buku

Petugas dapat menambahkan gambar sampul buku agar tampilan katalog lebih menarik.

---

## Alur Sistem

```text
Petugas Login
      │
      ▼
Manajemen Buku
      │
      ├── Tambah Buku
      ├── Ubah Buku
      ├── Hapus Buku
      ├── Kelola Stok
      └── Upload Cover
      │
      ▼
Data Disimpan
      │
      ▼
Katalog Buku Diperbarui
```

---

## Business Rules

* Kode buku harus unik.
* Satu buku hanya memiliki satu kategori utama.
* Jumlah stok tidak boleh bernilai negatif.
* Buku yang sedang dipinjam tidak dapat dihapus.
* Perubahan stok dilakukan otomatis oleh sistem berdasarkan transaksi.
* Buku yang stoknya habis tetap ditampilkan pada katalog dengan status **Tidak Tersedia**.

---

## Validasi

Apabila data belum lengkap:

> Seluruh data wajib diisi.

Apabila kode buku sudah digunakan:

> Kode buku sudah terdaftar.

Apabila stok tidak valid:

> Jumlah stok tidak sesuai.

---

## Manfaat

### Bagi Petugas

* Mempermudah pengelolaan koleksi buku.
* Mengurangi kesalahan pencatatan.
* Memantau kondisi stok dengan lebih mudah.

### Bagi Pengguna

* Mendapatkan informasi buku yang akurat.
* Mengetahui ketersediaan buku secara real-time.

---

## Future Development

* Cetak barcode atau QR Code buku.
* Import data buku dari file Excel.
* Export data buku ke Excel atau PDF.
* Riwayat perubahan data buku.
* Rekomendasi buku berdasarkan kategori.

---

# FR-005 Manajemen Kategori Buku

## Deskripsi

Fitur Manajemen Kategori Buku digunakan untuk mengelompokkan koleksi buku berdasarkan klasifikasi sehingga memudahkan proses pencarian, pengelolaan, dan penyusunan koleksi perpustakaan.

Sistem menggunakan klasifikasi **Dewey Decimal Classification (DDC)** sesuai hasil observasi di Perpustakaan Acitya Wiguna.

---

## Tujuan

* Mengelompokkan koleksi buku secara terstruktur.
* Mempermudah pencarian buku.
* Mempermudah pengelolaan data buku.
* Menyesuaikan sistem dengan standar klasifikasi perpustakaan.

---

## Hak Akses

| Role          | Hak Akses               |
| ------------- | ----------------------- |
| Petugas       | Mengelola kategori buku |
| Siswa         | Melihat kategori        |
| Guru/Karyawan | Melihat kategori        |

---

## Daftar Kategori

Kategori buku yang tersedia meliputi:

| Kode | Kategori               |
| ---- | ---------------------- |
| 000  | Karya Umum             |
| 100  | Filsafat dan Psikologi |
| 200  | Agama                  |
| 300  | Ilmu Sosial            |
| 400  | Bahasa                 |
| 500  | Ilmu Murni             |
| 600  | Ilmu Terapan           |
| 700  | Seni dan Olahraga      |
| 800  | Kesusastraan           |
| 900  | Sejarah dan Geografi   |

---

## Fitur

Petugas dapat:

* Menambah kategori.
* Mengubah kategori.
* Menghapus kategori.
* Menampilkan daftar kategori.
* Menghubungkan kategori dengan data buku.

---

## Business Rules

* Kategori yang masih digunakan oleh buku tidak dapat dihapus.
* Setiap buku hanya memiliki satu kategori utama.
* Nama kategori tidak boleh sama.

---

## Validasi

Apabila kategori sudah ada:

> Kategori sudah tersedia.

Apabila kategori masih digunakan:

> Kategori tidak dapat dihapus karena masih digunakan oleh data buku.

---

## Manfaat

### Bagi Petugas

* Pengelolaan koleksi menjadi lebih terstruktur.
* Mempermudah proses pendataan.

### Bagi Pengguna

* Mempermudah pencarian buku berdasarkan bidang ilmu.

---

## Future Development

* Penambahan subkategori.
* Pencarian berdasarkan kategori favorit.
* Statistik jumlah buku pada setiap kategori.

---

# FR-006 Manajemen Anggota

## Deskripsi

Manajemen Anggota merupakan fitur yang digunakan untuk mengelola seluruh data anggota perpustakaan. Anggota terdiri dari siswa, guru, dan karyawan yang memiliki hak untuk menggunakan layanan perpustakaan sesuai dengan ketentuan yang berlaku.

Fitur ini memudahkan petugas dalam melakukan pendataan anggota, memperbarui informasi, mengelola status keanggotaan, serta memantau aktivitas peminjaman setiap anggota.

---

## Tujuan

* Mengelola data anggota perpustakaan secara terpusat.
* Mempermudah proses login berdasarkan identitas pengguna.
* Mempermudah proses peminjaman dan pengembalian.
* Menyimpan riwayat aktivitas setiap anggota.
* Mengelola status anggota secara otomatis.

---

## Hak Akses

| Role          | Hak Akses                              |
| ------------- | -------------------------------------- |
| Petugas       | Mengelola seluruh data anggota         |
| Siswa         | Melihat dan memperbarui profil pribadi |
| Guru/Karyawan | Melihat dan memperbarui profil pribadi |

---

## Jenis Anggota

### Siswa

Data yang disimpan:

* Nama Lengkap
* NIS/NISN
* Kelas
* Jurusan
* Nomor Telepon (Opsional)
* Email (Opsional)
* Status Anggota
* Tanggal Bergabung

### Guru/Karyawan

Data yang disimpan:

* Nama Lengkap
* NIP
* Jabatan
* Nomor Telepon (Opsional)
* Email (Opsional)
* Status Anggota
* Tanggal Bergabung

---

## Fitur Manajemen Anggota

Petugas dapat melakukan:

* Menambahkan anggota baru.
* Mengubah data anggota.
* Menghapus anggota.
* Mengaktifkan atau menonaktifkan anggota.
* Mengubah status menjadi Alumni.
* Mencari anggota.
* Melihat riwayat aktivitas anggota.

---

## Status Anggota

Status anggota terdiri dari:

* Aktif
* Alumni
* Nonaktif

### Keterangan

* **Aktif** dapat menggunakan seluruh layanan perpustakaan.
* **Alumni** tidak dapat melakukan peminjaman baru, tetapi riwayat tetap tersimpan.
* **Nonaktif** tidak dapat mengakses layanan hingga status diaktifkan kembali.

---

## Alur Sistem

```text
Petugas Login
      │
      ▼
Manajemen Anggota
      │
      ├── Tambah Anggota
      ├── Edit Anggota
      ├── Hapus Anggota
      ├── Ubah Status
      └── Lihat Riwayat
      │
      ▼
Data Tersimpan
```

---

## Business Rules

* NIS/NISN dan NIP harus unik.
* Status Alumni tidak dapat melakukan peminjaman baru.
* Riwayat anggota tidak boleh dihapus meskipun status berubah.
* Pengguna hanya dapat mengubah data profil pribadinya.

---

## Validasi

Apabila NIS/NISN atau NIP sudah digunakan:

> Data anggota sudah terdaftar.

Apabila data wajib belum diisi:

> Mohon lengkapi seluruh data anggota.

---

## Manfaat

### Bagi Petugas

* Mempermudah pengelolaan anggota.
* Mengurangi kesalahan pendataan.
* Mempermudah pencarian data.

### Bagi Pengguna

* Data anggota tersimpan dengan baik.
* Profil dapat diperbarui dengan mudah.

---

## Future Development

* Sinkronisasi dengan database sekolah.
* Import data anggota dari Excel.
* Cetak kartu anggota dengan QR Code.
* Foto profil anggota.

---

# FR-007 Buku Kunjungan Digital

## Deskripsi

Buku Kunjungan Digital merupakan fitur yang digunakan untuk mencatat seluruh aktivitas kunjungan anggota perpustakaan secara elektronik. Fitur ini menggantikan buku kunjungan manual sehingga data lebih mudah dikelola dan dapat dijadikan bahan evaluasi perpustakaan.

Setiap anggota yang datang ke perpustakaan diwajibkan mengisi data kunjungan sebelum menggunakan layanan.

---

## Tujuan

* Mendigitalisasi buku kunjungan.
* Mencatat aktivitas kunjungan secara otomatis.
* Mengetahui tingkat kunjungan perpustakaan.
* Menjadi salah satu indikator aktivitas literasi.

---

## Hak Akses

| Role          | Hak Akses                             |
| ------------- | ------------------------------------- |
| Petugas       | Melihat seluruh data kunjungan        |
| Siswa         | Mengisi dan melihat riwayat kunjungan |
| Guru/Karyawan | Mengisi dan melihat riwayat kunjungan |

---

## Data Kunjungan

Data yang dicatat meliputi:

* Nama Pengunjung
* NIS/NIP
* Role
* Tanggal Kunjungan
* Waktu Masuk
* Tujuan Kunjungan
* Catatan (Opsional)

---

## Tujuan Kunjungan

Pengguna dapat memilih salah satu tujuan berikut:

* Membaca Buku
* Meminjam Buku
* Mengembalikan Buku
* Mencari Referensi
* Belajar
* Keperluan Lainnya

---

## Fitur

* Mengisi buku kunjungan.
* Melihat riwayat kunjungan.
* Mencari data kunjungan.
* Filter berdasarkan tanggal.
* Rekap jumlah kunjungan.

---

## Alur Sistem

```text
Pengguna Login
      │
      ▼
Menu Buku Kunjungan
      │
      ▼
Mengisi Data Kunjungan
      │
      ▼
Sistem Menyimpan Data
      │
      ▼
Riwayat Kunjungan Bertambah
```

---

## Business Rules

* Setiap kunjungan hanya dapat dicatat satu kali dalam satu hari.
* Data kunjungan tersimpan secara otomatis.
* Riwayat kunjungan menjadi bagian dari profil pengguna.
* Data kunjungan digunakan sebagai salah satu indikator penilaian achievement dan leaderboard.

---

## Validasi

Apabila pengguna sudah melakukan kunjungan pada hari yang sama:

> Kunjungan hari ini telah tercatat.

---

## Manfaat

### Bagi Petugas

* Mempermudah rekapitulasi jumlah pengunjung.
* Menghilangkan pencatatan manual.
* Menyediakan data statistik kunjungan.

### Bagi Pengguna

* Tidak perlu mengisi buku tamu secara manual.
* Riwayat kunjungan dapat dilihat kapan saja.

---

## Future Development

* Check-in menggunakan QR Code.
* Integrasi dengan kartu pelajar.
* Statistik kunjungan bulanan.
* Grafik kunjungan berdasarkan kategori pengguna.
* Dashboard analisis tingkat kunjungan.

---

# FR-008 Katalog Buku

## Deskripsi

Katalog Buku merupakan fitur yang digunakan untuk menampilkan seluruh koleksi buku yang tersedia di Perpustakaan Acitya Wiguna. Melalui fitur ini, pengguna dapat mencari buku, melihat informasi detail buku, mengetahui ketersediaan stok, serta menemukan lokasi penyimpanan buku di perpustakaan.

Fitur ini dapat diakses oleh seluruh pengguna, baik sebelum maupun sesudah login, dengan hak akses yang berbeda.

---

## Tujuan

* Mempermudah pengguna mencari buku.
* Menampilkan informasi buku secara lengkap.
* Menampilkan status ketersediaan buku secara real-time.
* Mengurangi waktu pencarian buku di perpustakaan.

---

## Hak Akses

| Role          | Hak Akses                                                        |
| ------------- | ---------------------------------------------------------------- |
| Pengunjung    | Melihat katalog buku                                             |
| Siswa         | Melihat dan mencari buku                                         |
| Guru/Karyawan | Melihat dan mencari buku                                         |
| Petugas       | Melihat katalog serta mengelola data buku melalui Manajemen Buku |

---

## Informasi Buku

Setiap buku menampilkan informasi sebagai berikut:

* Cover Buku
* Judul Buku
* Penulis
* Penerbit
* Tahun Terbit
* Kategori
* Klasifikasi DDC
* Lokasi Rak
* Deskripsi Singkat
* Status Ketersediaan
* Jumlah Stok Tersedia

---

## Fitur Katalog

Pengguna dapat:

* Mencari buku berdasarkan judul.
* Mencari buku berdasarkan penulis.
* Mencari berdasarkan kategori.
* Melakukan filter berdasarkan klasifikasi DDC.
* Melihat detail buku.
* Mengetahui lokasi rak.
* Melihat jumlah stok yang tersedia.

---

## Status Buku

Status buku ditampilkan secara otomatis berdasarkan jumlah stok.

| Status      | Keterangan                   |
| ----------- | ---------------------------- |
| Tersedia    | Buku masih dapat dipinjam    |
| Dipinjam    | Seluruh stok sedang dipinjam |
| Tidak Aktif | Buku tidak dapat dipinjam    |

---

## Alur Sistem

```text
Pengguna membuka Katalog Buku
        │
        ▼
Mencari atau Memilih Buku
        │
        ▼
Sistem Menampilkan Hasil
        │
        ▼
Pengguna Melihat Detail Buku
        │
        ▼
Jika Login
        │
        ▼
Dapat Mengajukan Peminjaman
```

---

## Business Rules

* Informasi stok diperbarui secara otomatis.
* Buku yang stoknya habis tetap ditampilkan.
* Hanya pengguna yang sudah login yang dapat mengajukan peminjaman.
* Buku yang berstatus Tidak Aktif tidak dapat dipinjam.

---

## Validasi

Apabila pencarian tidak ditemukan:

> Buku yang Anda cari tidak ditemukan.

---

## Manfaat

### Bagi Pengguna

* Mempermudah pencarian buku.
* Mengetahui ketersediaan buku sebelum datang ke rak.
* Mempercepat proses peminjaman.

### Bagi Petugas

* Mengurangi pertanyaan mengenai ketersediaan buku.
* Mempermudah penyebaran informasi koleksi perpustakaan.

---

## Future Development

* Rekomendasi buku berdasarkan riwayat peminjaman.
* Buku favorit.
* Buku terbaru.
* Buku paling sering dipinjam.
* Pencarian menggunakan QR Code.

---

# FR-009 Peminjaman Buku

## Deskripsi

Fitur Peminjaman Buku digunakan untuk mengelola proses peminjaman koleksi perpustakaan oleh siswa, guru, maupun karyawan. Seluruh transaksi dicatat secara digital sehingga lebih mudah dipantau oleh petugas.

Sistem akan melakukan pemeriksaan kuota peminjaman, status anggota, dan ketersediaan buku sebelum peminjaman diproses.

---

## Tujuan

* Mempermudah proses peminjaman buku.
* Mengurangi pencatatan manual.
* Mengontrol jumlah buku yang dipinjam.
* Menyimpan riwayat peminjaman secara otomatis.

---

## Hak Akses

| Role          | Hak Akses                |
| ------------- | ------------------------ |
| Petugas       | Mengonfirmasi peminjaman |
| Siswa         | Mengajukan peminjaman    |
| Guru/Karyawan | Mengajukan peminjaman    |

---

## Alur Peminjaman

```text
Pengguna Login
      │
      ▼
Membuka Detail Buku
      │
      ▼
Klik "Ajukan Peminjaman"
      │
      ▼
Sistem Memeriksa:
- Status Anggota
- Kuota Peminjaman
- Ketersediaan Buku
      │
      ▼
Petugas Melakukan Konfirmasi
      │
      ▼
Status Peminjaman Aktif
      │
      ▼
Stok Buku Berkurang Otomatis
```

---

## Aturan Peminjaman

### Buku Umum

* Maksimal **3 buku**.
* Lama peminjaman **7 hari**.
* Dapat diperpanjang sesuai kebijakan petugas.

### Buku Paket

Buku paket memiliki aturan khusus.

* Tidak mengikuti batas maksimal 3 buku.
* Masa peminjaman mengikuti kebijakan sekolah.
* Digunakan selama periode pembelajaran atau satu semester jika diperlukan.

---

## Data Peminjaman

Data yang disimpan meliputi:

* ID Peminjaman
* Nama Anggota
* Buku yang Dipinjam
* Tanggal Peminjaman
* Tanggal Jatuh Tempo
* Status Peminjaman
* Petugas yang Mengonfirmasi

---

## Status Peminjaman

| Status               | Keterangan                                                 |
| -------------------- | ---------------------------------------------------------- |
| Menunggu Persetujuan | Pengajuan belum dikonfirmasi petugas                       |
| Dipinjam             | Buku sedang dipinjam                                       |
| Dikembalikan         | Buku telah dikembalikan                                    |
| Terlambat            | Melewati tanggal jatuh tempo                               |
| Penggantian Buku     | Buku dinyatakan hilang dan sedang dalam proses penggantian |

---

## Business Rules

* Hanya anggota dengan status **Aktif** yang dapat meminjam buku.
* Pengguna tidak dapat meminjam apabila kuota telah penuh.
* Pengguna tidak dapat meminjam buku yang stoknya habis.
* Tanggal jatuh tempo dihitung otomatis oleh sistem.
* Setiap transaksi harus dikonfirmasi oleh petugas.
* Setelah peminjaman disetujui, stok buku berkurang secara otomatis.
* Riwayat peminjaman tersimpan secara permanen.
* Data peminjaman digunakan sebagai dasar perhitungan Achievement dan Leaderboard.

---

## Validasi

Apabila kuota penuh:

> Kuota peminjaman telah mencapai batas maksimal.

Apabila stok habis:

> Buku sedang tidak tersedia.

Apabila status anggota bukan Aktif:

> Status keanggotaan tidak memenuhi syarat untuk melakukan peminjaman.

---

## Manfaat

### Bagi Petugas

* Mempermudah pengelolaan transaksi.
* Mengurangi kesalahan pencatatan.
* Mempermudah pemantauan peminjaman aktif.

### Bagi Pengguna

* Proses peminjaman lebih cepat.
* Riwayat peminjaman tersimpan dengan baik.
* Dapat mengetahui tanggal pengembalian secara jelas.

---

## Future Development

* Persetujuan peminjaman melalui QR Code.
* Notifikasi otomatis melalui email atau WhatsApp.
* Reservasi buku yang sedang dipinjam.
* Perpanjangan peminjaman secara mandiri sesuai kebijakan perpustakaan.

---

# FR-010 Pengembalian Buku

## Deskripsi

Fitur Pengembalian Buku digunakan untuk mencatat proses pengembalian buku yang telah dipinjam oleh anggota perpustakaan. Seluruh transaksi pengembalian dilakukan melalui petugas perpustakaan agar kondisi buku dapat diperiksa sebelum transaksi dinyatakan selesai.

Setelah proses pengembalian berhasil, sistem akan memperbarui status peminjaman menjadi **Dikembalikan** dan menambahkan stok buku secara otomatis.

---

## Tujuan

* Mempermudah proses pengembalian buku.
* Memastikan kondisi buku setelah dipinjam.
* Memperbarui stok buku secara otomatis.
* Menyimpan riwayat pengembalian.

---

## Hak Akses

| Role          | Hak Akses                   |
| ------------- | --------------------------- |
| Petugas       | Mengonfirmasi pengembalian  |
| Siswa         | Melihat status pengembalian |
| Guru/Karyawan | Melihat status pengembalian |

---

## Data Pengembalian

Data yang disimpan meliputi:

* ID Pengembalian
* ID Peminjaman
* Nama Anggota
* Judul Buku
* Tanggal Peminjaman
* Tanggal Jatuh Tempo
* Tanggal Pengembalian
* Status Pengembalian
* Kondisi Buku
* Catatan Petugas (Opsional)

---

## Kondisi Buku

Petugas memilih kondisi buku saat dikembalikan.

* Baik
* Rusak Ringan
* Rusak Berat
* Hilang

Apabila kondisi buku **Hilang**, sistem akan mengarahkan transaksi ke proses **Penggantian Buku Hilang**.

---

## Alur Sistem

```text
Pengguna Datang ke Perpustakaan
        │
        ▼
Petugas Memilih Data Peminjaman
        │
        ▼
Petugas Memeriksa Kondisi Buku
        │
        ▼
Buku Dikembalikan?
      │             │
     Ya          Hilang
      │             │
      ▼             ▼
Stok Bertambah   Proses Penggantian Buku
      │
      ▼
Riwayat Diperbarui
```

---

## Business Rules

* Pengembalian hanya dapat dikonfirmasi oleh petugas.
* Stok buku bertambah otomatis setelah pengembalian berhasil.
* Riwayat peminjaman berubah menjadi **Dikembalikan**.
* Apabila buku dinyatakan hilang, transaksi belum selesai hingga buku pengganti diterima.
* Tidak ada denda uang atas keterlambatan sesuai kebijakan perpustakaan.

---

## Validasi

Apabila transaksi tidak ditemukan:

> Data peminjaman tidak ditemukan.

Apabila buku sudah pernah dikembalikan:

> Buku telah dikembalikan sebelumnya.

---

## Manfaat

### Bagi Petugas

* Mempermudah proses pengembalian.
* Memastikan kondisi koleksi tetap terpantau.
* Mengurangi kesalahan pencatatan stok.

### Bagi Pengguna

* Riwayat pengembalian tersimpan dengan baik.
* Status peminjaman diperbarui secara otomatis.

---

## Future Development

* Scan barcode atau QR Code buku saat pengembalian.
* Riwayat kondisi buku.
* Statistik tingkat keterlambatan pengembalian.
* Notifikasi otomatis setelah pengembalian berhasil.

---

# FR-011 Penggantian Buku Hilang

## Deskripsi

Fitur Penggantian Buku Hilang digunakan ketika anggota perpustakaan kehilangan buku yang dipinjam. Berdasarkan hasil observasi di Perpustakaan Acitya Wiguna, **tidak diterapkan denda uang**. Sebagai gantinya, anggota diwajibkan mengganti buku yang hilang dengan buku yang sama atau buku lain yang setara sesuai persetujuan petugas.

Transaksi peminjaman akan tetap berstatus **Penggantian Buku** hingga buku pengganti diterima dan diverifikasi oleh petugas.

---

## Tujuan

* Mengelola proses penggantian buku yang hilang.
* Menjaga kelengkapan koleksi perpustakaan.
* Menghindari kehilangan koleksi tanpa penggantian.
* Mendokumentasikan seluruh proses penggantian.

---

## Hak Akses

| Role          | Hak Akses                                    |
| ------------- | -------------------------------------------- |
| Petugas       | Mengelola dan mengonfirmasi penggantian buku |
| Siswa         | Melihat status penggantian buku              |
| Guru/Karyawan | Melihat status penggantian buku              |

---

## Data Penggantian

Data yang disimpan meliputi:

* ID Penggantian
* ID Peminjaman
* Nama Anggota
* Buku yang Hilang
* Tanggal Dilaporkan
* Buku Pengganti
* Status Penggantian
* Tanggal Penyelesaian
* Catatan Petugas

---

## Status Penggantian

| Status               | Keterangan                                           |
| -------------------- | ---------------------------------------------------- |
| Menunggu Penggantian | Pengguna belum menyerahkan buku pengganti            |
| Menunggu Verifikasi  | Buku pengganti telah diserahkan dan sedang diperiksa |
| Selesai              | Buku pengganti diterima dan transaksi selesai        |

---

## Alur Sistem

```text
Buku Dinyatakan Hilang
        │
        ▼
Petugas Mengubah Status Menjadi
"Penggantian Buku"
        │
        ▼
Pengguna Menyerahkan Buku Pengganti
        │
        ▼
Petugas Memverifikasi
        │
        ▼
Sesuai?
     │        │
    Ya      Tidak
     │        │
     ▼        ▼
Status     Pengguna
Selesai    Diminta Mengganti Kembali
```

---

## Business Rules

* Buku yang hilang wajib diganti dengan buku yang sama atau buku lain yang setara sesuai persetujuan petugas.
* Selama proses penggantian belum selesai, transaksi peminjaman tetap berstatus **Penggantian Buku**.
* Setelah buku pengganti diterima dan diverifikasi, transaksi dinyatakan selesai.
* Tidak dikenakan denda uang atas kehilangan buku.
* Petugas berhak menentukan kelayakan buku pengganti.
* Riwayat penggantian buku disimpan sebagai arsip perpustakaan.

---

## Validasi

Apabila buku pengganti tidak sesuai:

> Buku pengganti belum memenuhi ketentuan perpustakaan.

Apabila transaksi penggantian tidak ditemukan:

> Data penggantian buku tidak ditemukan.

---

## Manfaat

### Bagi Petugas

* Mempermudah pemantauan proses penggantian buku.
* Menjaga koleksi perpustakaan tetap lengkap.
* Mendokumentasikan seluruh riwayat penggantian.

### Bagi Pengguna

* Mengetahui status proses penggantian secara jelas.
* Memastikan transaksi selesai setelah buku pengganti diterima.

---

## Future Development

* Unggah bukti pembelian buku pengganti.
* Notifikasi pengingat bagi pengguna yang belum menyerahkan buku pengganti.
* Statistik jumlah buku hilang dan penggantian per periode.
* Laporan khusus penggantian buku.

---

# FR-012 Riwayat Peminjaman

## Deskripsi

Fitur Riwayat Peminjaman digunakan untuk menyimpan dan menampilkan seluruh riwayat transaksi peminjaman buku yang pernah dilakukan oleh anggota perpustakaan. Riwayat ini dapat diakses oleh petugas, siswa, maupun guru/karyawan sesuai dengan hak akses masing-masing.

Data riwayat tidak akan dihapus meskipun transaksi telah selesai, sehingga dapat digunakan sebagai arsip dan bahan evaluasi aktivitas perpustakaan.

---

## Tujuan

* Menyimpan riwayat transaksi peminjaman secara permanen.
* Memudahkan pengguna melihat riwayat peminjaman.
* Membantu petugas dalam melakukan pencarian data transaksi.
* Menjadi dasar perhitungan achievement dan leaderboard.

---

## Hak Akses

| Role          | Hak Akses                          |
| ------------- | ---------------------------------- |
| Petugas       | Melihat seluruh riwayat peminjaman |
| Siswa         | Melihat riwayat peminjaman pribadi |
| Guru/Karyawan | Melihat riwayat peminjaman pribadi |

---

## Data Riwayat

Data yang ditampilkan meliputi:

* ID Peminjaman
* Nama Anggota
* Judul Buku
* Tanggal Peminjaman
* Tanggal Jatuh Tempo
* Tanggal Pengembalian
* Status Peminjaman
* Status Pengembalian
* Catatan Petugas (Opsional)

---

## Status Riwayat

| Status               | Keterangan                        |
| -------------------- | --------------------------------- |
| Menunggu Persetujuan | Pengajuan sedang diproses         |
| Dipinjam             | Buku masih dipinjam               |
| Dikembalikan         | Buku telah dikembalikan           |
| Terlambat            | Pengembalian melewati jatuh tempo |
| Penggantian Buku     | Sedang mengganti buku yang hilang |

---

## Fitur

Pengguna dapat:

* Melihat seluruh riwayat peminjaman.
* Mencari riwayat berdasarkan judul buku.
* Memfilter berdasarkan status.
* Memfilter berdasarkan tanggal.
* Melihat detail transaksi.

Petugas juga dapat:

* Melihat seluruh riwayat anggota.
* Mencari transaksi berdasarkan nama anggota.
* Melakukan pencarian berdasarkan ID transaksi.

---

## Alur Sistem

```text
Pengguna Login
      │
      ▼
Menu Riwayat Peminjaman
      │
      ▼
Sistem Menampilkan Daftar Riwayat
      │
      ▼
Pengguna Memilih Salah Satu Riwayat
      │
      ▼
Detail Transaksi Ditampilkan
```

---

## Business Rules

* Seluruh transaksi disimpan sebagai arsip.
* Pengguna hanya dapat melihat riwayat miliknya sendiri.
* Petugas dapat melihat seluruh riwayat.
* Riwayat tidak dapat dihapus.
* Data riwayat digunakan sebagai dasar statistik perpustakaan.

---

## Validasi

Apabila belum terdapat transaksi:

> Belum ada riwayat peminjaman.

---

## Manfaat

### Bagi Petugas

* Mempermudah pencarian transaksi.
* Menjadi arsip digital perpustakaan.

### Bagi Pengguna

* Mengetahui seluruh aktivitas peminjaman.
* Memudahkan pengecekan status buku.

---

## Future Development

* Export riwayat ke PDF.
* Filter berdasarkan tahun ajaran.
* Grafik aktivitas membaca setiap pengguna.

---

# FR-013 Achievement

## Deskripsi

Achievement merupakan fitur penghargaan otomatis yang diberikan kepada anggota perpustakaan berdasarkan aktivitas yang dilakukan di dalam sistem. Penghargaan ini bertujuan untuk meningkatkan minat baca, mendorong kedisiplinan, serta memberikan apresiasi kepada pengguna yang aktif memanfaatkan layanan perpustakaan.

Achievement dihitung secara otomatis oleh sistem tanpa perlu dibuat atau diberikan secara manual oleh petugas.

---

## Tujuan

* Meningkatkan budaya literasi.
* Memberikan motivasi kepada pengguna.
* Memberikan penghargaan atas aktivitas positif.
* Menjadikan perpustakaan lebih interaktif.

---

## Hak Akses

| Role          | Hak Akses                     |
| ------------- | ----------------------------- |
| Petugas       | Melihat statistik achievement |
| Siswa         | Melihat achievement pribadi   |
| Guru/Karyawan | Melihat achievement pribadi   |

---

## Daftar Achievement

| Achievement          | Syarat                                            |
| -------------------- | ------------------------------------------------- |
| Pembaca Pemula       | Pertama kali meminjam buku                        |
| Sahabat Perpustakaan | Meminjam 10 buku                                  |
| Penjelajah Ilmu      | Meminjam 25 buku                                  |
| Duta Literasi        | Meminjam 50 buku                                  |
| Bintang Ketepatan    | Mengembalikan buku tepat waktu sebanyak 10 kali   |
| Pengunjung Aktif     | Melakukan kunjungan perpustakaan sebanyak 25 kali |
| Pecinta Literasi     | Melakukan kunjungan sebanyak 50 kali              |
| Top Reader           | Masuk peringkat pertama leaderboard bulanan       |

---

## Cara Kerja Sistem

```text
Aktivitas Pengguna
        │
        ▼
Data Tersimpan
        │
        ▼
Sistem Memeriksa Syarat Achievement
        │
        ▼
Syarat Terpenuhi?
      │          │
     Ya        Tidak
      │
      ▼
Achievement Terbuka
      │
      ▼
Notifikasi Ditampilkan
```

---

## Monitoring Petugas

Petugas tidak memberikan achievement secara manual.

Petugas hanya dapat:

* Melihat daftar pengguna yang memperoleh achievement.
* Melihat statistik achievement.
* Melihat jumlah achievement yang telah diperoleh setiap anggota.

---

## Business Rules

* Achievement diberikan secara otomatis.
* Setiap achievement hanya dapat diperoleh satu kali.
* Progress achievement diperbarui setiap ada aktivitas baru.
* Data diambil dari peminjaman, pengembalian, dan kunjungan perpustakaan.

---

## Validasi

Ketika achievement berhasil diperoleh:

> Selamat, Anda berhasil memperoleh achievement "Pembaca Pemula".

---

## Manfaat

### Bagi Perpustakaan

* Meningkatkan minat baca.
* Mendorong budaya literasi.

### Bagi Pengguna

* Memberikan motivasi untuk lebih aktif.
* Menjadi bentuk apresiasi atas aktivitas membaca.

---

## Future Development

* Badge dengan beberapa tingkatan.
* Koleksi achievement rahasia.
* Hadiah khusus untuk achievement tertentu.
* Sertifikat digital otomatis.

---

# FR-014 Leaderboard

## Deskripsi

Leaderboard merupakan fitur yang menampilkan peringkat anggota perpustakaan berdasarkan aktivitas yang telah dilakukan dalam periode tertentu. Peringkat dihitung secara otomatis oleh sistem menggunakan data peminjaman buku, pengembalian tepat waktu, serta kunjungan perpustakaan.

Fitur ini bertujuan untuk meningkatkan semangat literasi melalui kompetisi yang sehat antaranggota perpustakaan.

---

## Tujuan

* Meningkatkan minat baca.
* Memberikan apresiasi kepada anggota yang aktif.
* Mendorong budaya literasi di lingkungan sekolah.
* Menampilkan statistik aktivitas pengguna.

---

## Hak Akses

| Role          | Hak Akses                                 |
| ------------- | ----------------------------------------- |
| Petugas       | Melihat seluruh leaderboard dan statistik |
| Siswa         | Melihat leaderboard                       |
| Guru/Karyawan | Melihat leaderboard                       |

---

## Kategori Leaderboard

Sistem menyediakan beberapa kategori leaderboard, yaitu:

* Top Reader Bulanan
* Top Reader Semester
* Top Reader Tahunan

---

## Data Leaderboard

Informasi yang ditampilkan meliputi:

* Peringkat
* Nama Anggota
* Kelas/Jabatan
* Jumlah Buku Dipinjam
* Jumlah Kunjungan
* Achievement yang Dimiliki
* Total Poin

---

## Perhitungan Poin

Leaderboard dihitung berdasarkan aktivitas pengguna, misalnya:

| Aktivitas                 | Poin     |
| ------------------------- | -------- |
| Meminjam Buku             | +10 poin |
| Mengembalikan Tepat Waktu | +5 poin  |
| Mengunjungi Perpustakaan  | +2 poin  |
| Mendapat Achievement      | +20 poin |

> **Catatan:** Bobot poin dapat diubah oleh petugas sesuai kebijakan perpustakaan.

---

## Alur Sistem

```text
Aktivitas Pengguna
        │
        ▼
Data Aktivitas Tersimpan
        │
        ▼
Sistem Menghitung Total Poin
        │
        ▼
Sistem Memperbarui Peringkat
        │
        ▼
Leaderboard Ditampilkan
```

---

## Business Rules

* Leaderboard diperbarui secara otomatis.
* Peringkat dihitung berdasarkan total poin.
* Jika total poin sama, pengguna dengan jumlah peminjaman lebih banyak mendapat peringkat lebih tinggi.
* Leaderboard dapat difilter berdasarkan periode.
* Data leaderboard menjadi arsip dan dapat digunakan sebagai laporan.

---

## Validasi

Apabila belum terdapat aktivitas pengguna:

> Belum ada data leaderboard.

---

## Manfaat

### Bagi Petugas

* Mempermudah pemantauan anggota yang aktif.
* Menjadi bahan evaluasi kegiatan literasi.

### Bagi Pengguna

* Menambah motivasi membaca.
* Mendorong partisipasi aktif di perpustakaan.

---

## Future Development

* Leaderboard per kelas.
* Leaderboard per jurusan.
* Grafik perkembangan peringkat.
* Hadiah otomatis bagi Top Reader.
* Sertifikat digital bagi peringkat terbaik.

---

# FR-015 Pengumuman

## Deskripsi

Fitur Pengumuman digunakan untuk menyampaikan informasi resmi dari perpustakaan kepada seluruh pengguna sistem. Pengumuman dapat berupa informasi jam operasional, buku baru, kegiatan perpustakaan, perubahan tata tertib, maupun informasi penting lainnya.

Semua pengumuman dikelola oleh petugas dan dapat dilihat oleh seluruh pengguna setelah login.

---

## Tujuan

* Menyampaikan informasi secara cepat.
* Mengurangi penyampaian informasi secara manual.
* Memastikan seluruh pengguna memperoleh informasi terbaru.

---

## Hak Akses

| Role          | Hak Akses                                |
| ------------- | ---------------------------------------- |
| Petugas       | Menambah, mengubah, menghapus pengumuman |
| Siswa         | Melihat pengumuman                       |
| Guru/Karyawan | Melihat pengumuman                       |

---

## Data Pengumuman

Data yang disimpan meliputi:

* Judul Pengumuman
* Isi Pengumuman
* Tanggal Publikasi
* Tanggal Berakhir (Opsional)
* Status (Aktif/Tidak Aktif)
* Dibuat Oleh

---

## Fitur

Petugas dapat:

* Menambahkan pengumuman.
* Mengubah pengumuman.
* Menghapus pengumuman.
* Mengaktifkan atau menonaktifkan pengumuman.

Pengguna dapat:

* Melihat daftar pengumuman.
* Membaca detail pengumuman.
* Mengetahui tanggal publikasi.

---

## Alur Sistem

```text
Petugas Login
      │
      ▼
Menu Pengumuman
      │
      ▼
Tambah / Edit / Hapus
      │
      ▼
Pengumuman Dipublikasikan
      │
      ▼
Pengguna Melihat Pengumuman
```

---

## Business Rules

* Hanya petugas yang dapat mengelola pengumuman.
* Pengumuman aktif akan langsung ditampilkan pada dashboard.
* Pengumuman yang telah melewati tanggal berakhir akan otomatis berstatus tidak aktif.
* Riwayat pengumuman tetap tersimpan sebagai arsip.

---

## Validasi

Apabila judul atau isi pengumuman belum diisi:

> Mohon lengkapi data pengumuman.

---

## Manfaat

### Bagi Petugas

* Mempermudah penyampaian informasi.
* Mengurangi penggunaan media informasi manual.

### Bagi Pengguna

* Mendapatkan informasi terbaru secara cepat.
* Tidak ketinggalan informasi mengenai perpustakaan.

---

## Future Development

* Lampiran file pada pengumuman.
* Pengumuman dengan gambar.
* Notifikasi otomatis saat ada pengumuman baru.
* Kategori pengumuman (Umum, Kegiatan, Buku Baru, dan lainnya).

---

# FR-016 Laporan

## Deskripsi

Fitur Laporan digunakan untuk menyajikan data operasional perpustakaan dalam bentuk laporan yang terstruktur. Laporan dapat digunakan sebagai bahan evaluasi, dokumentasi, serta pelaporan kepada pihak sekolah.

Seluruh laporan dihasilkan secara otomatis berdasarkan data yang tersimpan di dalam sistem sehingga mengurangi proses rekapitulasi secara manual.

---

## Tujuan

* Mempermudah pembuatan laporan perpustakaan.
* Menyediakan data yang akurat dan terstruktur.
* Mendukung evaluasi kegiatan perpustakaan.
* Mengurangi proses rekapitulasi manual.

---

## Hak Akses

| Role          | Hak Akses                                         |
| ------------- | ------------------------------------------------- |
| Petugas       | Melihat, mencari, mencetak, dan mengunduh laporan |
| Siswa         | Tidak memiliki akses                              |
| Guru/Karyawan | Tidak memiliki akses                              |

---

## Jenis Laporan

Sistem menyediakan beberapa jenis laporan, yaitu:

* Laporan Data Buku
* Laporan Data Anggota
* Laporan Kunjungan
* Laporan Peminjaman
* Laporan Pengembalian
* Laporan Buku Hilang
* Laporan Penggantian Buku
* Laporan Achievement
* Laporan Leaderboard
* Laporan Statistik Perpustakaan

---

## Fitur

Petugas dapat:

* Melihat laporan.
* Mencari data laporan.
* Memfilter laporan berdasarkan tanggal.
* Memfilter berdasarkan kategori atau jenis laporan.
* Mencetak laporan.
* Mengunduh laporan dalam format PDF atau Excel.

---

## Alur Sistem

```text
Petugas Login
      │
      ▼
Menu Laporan
      │
      ▼
Memilih Jenis Laporan
      │
      ▼
Menentukan Periode
      │
      ▼
Sistem Menampilkan Laporan
      │
      ├── Cetak
      └── Unduh
```

---

## Business Rules

* Laporan hanya dapat diakses oleh petugas.
* Data laporan diambil secara otomatis dari database.
* Laporan dapat difilter berdasarkan periode tertentu.
* Data laporan tidak dapat diubah melalui menu laporan.

---

## Validasi

Apabila data tidak ditemukan:

> Tidak terdapat data pada periode yang dipilih.

---

## Manfaat

### Bagi Petugas

* Mempermudah penyusunan laporan.
* Menghemat waktu administrasi.
* Mendukung proses evaluasi perpustakaan.

### Bagi Sekolah

* Memperoleh data perpustakaan yang akurat.
* Mendukung pengambilan keputusan berdasarkan data.

---

## Future Development

* Dashboard analitik interaktif.
* Grafik statistik otomatis.
* Pengiriman laporan melalui email.
* Penjadwalan laporan otomatis.

---

# FR-017 Backup Database

## Deskripsi

Fitur Backup Database digunakan untuk menjaga keamanan data perpustakaan dengan membuat salinan database secara berkala. Backup dapat digunakan untuk memulihkan data apabila terjadi kerusakan sistem, kehilangan data, atau kesalahan saat pengelolaan database.

---

## Tujuan

* Mencegah kehilangan data.
* Mempermudah proses pemulihan data.
* Menjaga keamanan informasi perpustakaan.
* Mendukung keberlangsungan operasional sistem.

---

## Hak Akses

| Role          | Hak Akses                             |
| ------------- | ------------------------------------- |
| Petugas       | Melakukan backup dan restore database |
| Siswa         | Tidak memiliki akses                  |
| Guru/Karyawan | Tidak memiliki akses                  |

---

## Fitur

Petugas dapat:

* Melakukan backup database secara manual.
* Melakukan restore database.
* Melihat riwayat backup.
* Mengunduh file backup.

---

## Alur Sistem

```text
Petugas Login
      │
      ▼
Menu Backup Database
      │
      ├── Backup Database
      ├── Restore Database
      └── Riwayat Backup
      │
      ▼
Proses Selesai
```

---

## Business Rules

* Backup hanya dapat dilakukan oleh petugas.
* Sistem mencatat tanggal dan waktu setiap proses backup.
* Restore hanya dapat dilakukan menggunakan file backup yang valid.
* Backup tidak menghapus data asli pada sistem.

---

## Validasi

Apabila proses backup berhasil:

> Backup database berhasil dibuat.

Apabila file backup tidak valid:

> File backup tidak dapat diproses.

---

## Manfaat

### Bagi Petugas

* Mengurangi risiko kehilangan data.
* Mempermudah proses pemulihan sistem.

### Bagi Perpustakaan

* Menjaga keamanan dan keberlangsungan data operasional.

---

## Future Development

* Backup otomatis berdasarkan jadwal.
* Penyimpanan backup di cloud.
* Notifikasi apabila backup gagal.
* Enkripsi file backup.

---

# FR-018 Status Alumni

## Deskripsi

Status Alumni merupakan fitur yang mengubah status keanggotaan siswa secara otomatis setelah masa belajar berakhir. Perubahan status ini bertujuan untuk menjaga validitas data anggota serta membatasi akses terhadap layanan peminjaman tanpa menghapus riwayat aktivitas yang pernah dilakukan.

---

## Tujuan

* Mengelola status keanggotaan secara otomatis.
* Menjaga keakuratan data anggota.
* Mencegah peminjaman oleh anggota yang sudah lulus.
* Menyimpan arsip riwayat perpustakaan.

---

## Hak Akses

| Role          | Hak Akses                                      |
| ------------- | ---------------------------------------------- |
| Petugas       | Melihat dan mengubah status apabila diperlukan |
| Siswa         | Melihat status keanggotaan                     |
| Guru/Karyawan | Tidak berlaku                                  |

---

## Status Keanggotaan

| Status   | Keterangan                                                            |
| -------- | --------------------------------------------------------------------- |
| Aktif    | Dapat menggunakan seluruh layanan perpustakaan                        |
| Alumni   | Tidak dapat melakukan peminjaman baru, tetapi riwayat tetap tersimpan |
| Nonaktif | Tidak dapat mengakses layanan hingga status diaktifkan kembali        |

---

## Alur Sistem

```text
Data Tahun Kelulusan
        │
        ▼
Sistem Memeriksa Status Siswa
        │
        ▼
Masa Belajar Berakhir?
      │          │
     Ya       Tidak
      │
      ▼
Status Diubah Menjadi Alumni
      │
      ▼
Riwayat Tetap Disimpan
```

---

## Business Rules

* Perubahan status dapat dilakukan secara otomatis berdasarkan tahun kelulusan atau secara manual oleh petugas.
* Anggota dengan status Alumni tidak dapat melakukan peminjaman baru.
* Riwayat peminjaman, kunjungan, achievement, dan leaderboard tetap tersimpan sebagai arsip.
* Data alumni tidak dihapus dari sistem.

---

## Validasi

Apabila status berhasil diperbarui:

> Status anggota berhasil diperbarui menjadi Alumni.

---

## Manfaat

### Bagi Petugas

* Mempermudah pengelolaan data anggota.
* Mengurangi proses perubahan status secara manual.

### Bagi Perpustakaan

* Data anggota tetap rapi dan valid.
* Riwayat aktivitas tetap terdokumentasi.

---

## Future Development

* Sinkronisasi otomatis dengan sistem akademik sekolah.
* Arsip digital alumni.
* Statistik alumni berdasarkan tahun kelulusan.

---

# Penutup BAB III

Dengan selesainya **FR-001 hingga FR-018**, seluruh kebutuhan fungsional Sistem Informasi Perpustakaan Acitya Wiguna telah terdokumentasi secara lengkap. Fitur-fitur tersebut mencakup proses utama pengelolaan perpustakaan, mulai dari autentikasi pengguna, pengelolaan data buku dan anggota, pencatatan kunjungan, peminjaman, pengembalian, penggantian buku hilang, hingga fitur pendukung seperti achievement, leaderboard, laporan, backup database, dan pengelolaan status alumni.

Dokumen ini menjadi acuan utama dalam proses analisis, perancangan basis data, pembuatan antarmuka pengguna (UI/UX), implementasi sistem, serta pengujian aplikasi sehingga seluruh kebutuhan pengguna dapat terpenuhi secara terstruktur dan konsisten.

---

# BAB IV

# Data Requirements

---

# 4.1 Gambaran Umum

Data Requirements menjelaskan seluruh kebutuhan data yang digunakan dalam Sistem Informasi Perpustakaan Acitya Wiguna. Seluruh data disimpan dalam database agar proses pengelolaan perpustakaan dapat dilakukan secara terintegrasi, aman, dan mudah diakses.

Setiap data saling berhubungan sehingga mampu mendukung seluruh proses bisnis perpustakaan, mulai dari pengelolaan anggota, koleksi buku, transaksi peminjaman dan pengembalian, pencatatan kunjungan, hingga penyusunan laporan serta fitur pendukung lainnya.

Struktur data pada bab ini akan menjadi dasar dalam perancangan database, Entity Relationship Diagram (ERD), serta implementasi model pada tahap pengembangan aplikasi.

---

# 4.2 Data Master

Data master merupakan data utama yang menjadi dasar operasional sistem.

---

## A. Data Petugas

Data petugas digunakan sebagai akun administrator yang bertanggung jawab mengelola seluruh aktivitas perpustakaan.

| Field      | Tipe Data | Keterangan             |
| ---------- | --------- | ---------------------- |
| id         | BigInt    | Primary Key            |
| nip        | Varchar   | Nomor Induk Pegawai    |
| nama       | Varchar   | Nama lengkap           |
| username   | Varchar   | Username login         |
| password   | Varchar   | Password (terenkripsi) |
| email      | Varchar   | Email                  |
| no_hp      | Varchar   | Nomor telepon          |
| foto       | Varchar   | Foto profil            |
| status     | Enum      | Aktif / Nonaktif       |
| created_at | Timestamp | Tanggal dibuat         |
| updated_at | Timestamp | Tanggal diperbarui     |

---

## B. Data Anggota

Data anggota menyimpan seluruh pengguna perpustakaan, yaitu siswa, guru, dan karyawan.

| Field      | Tipe Data | Keterangan                |
| ---------- | --------- | ------------------------- |
| id         | BigInt    | Primary Key               |
| role       | Enum      | Siswa / Guru / Karyawan   |
| nama       | Varchar   | Nama lengkap              |
| nis_nisn   | Varchar   | Diisi jika siswa          |
| nip        | Varchar   | Diisi jika guru/karyawan  |
| kelas      | Varchar   | Khusus siswa              |
| jurusan    | Varchar   | Khusus siswa              |
| jabatan    | Varchar   | Khusus guru/karyawan      |
| email      | Varchar   | Email                     |
| no_hp      | Varchar   | Nomor telepon             |
| password   | Varchar   | Password login            |
| status     | Enum      | Aktif / Alumni / Nonaktif |
| created_at | Timestamp | Tanggal dibuat            |
| updated_at | Timestamp | Tanggal diperbarui        |

---

## C. Data Kategori Buku

Kategori buku digunakan berdasarkan klasifikasi Dewey Decimal Classification (DDC).

| Field         | Tipe Data | Keterangan    |
| ------------- | --------- | ------------- |
| id            | BigInt    | Primary Key   |
| kode_ddc      | Varchar   | Kode kategori |
| nama_kategori | Varchar   | Nama kategori |
| deskripsi     | Text      | Keterangan    |

### Kategori DDC

| Kode | Nama Kategori            |
| ---- | ------------------------ |
| 000  | Karya Umum               |
| 100  | Filsafat & Psikologi     |
| 200  | Agama                    |
| 300  | Ilmu Sosial              |
| 400  | Bahasa                   |
| 500  | Ilmu Murni               |
| 600  | Ilmu Terapan & Teknologi |
| 700  | Seni & Rekreasi          |
| 800  | Kesusastraan             |
| 900  | Sejarah & Geografi       |

---

## D. Data Buku

Data buku menyimpan seluruh koleksi perpustakaan.

| Field         | Tipe Data | Keterangan             |
| ------------- | --------- | ---------------------- |
| id            | BigInt    | Primary Key            |
| kategori_id   | BigInt    | Foreign Key            |
| kode_buku     | Varchar   | Kode buku              |
| isbn          | Varchar   | ISBN                   |
| judul         | Varchar   | Judul buku             |
| penulis       | Varchar   | Penulis                |
| penerbit      | Varchar   | Penerbit               |
| tahun_terbit  | Year      | Tahun terbit           |
| lokasi_rak    | Varchar   | Lokasi rak             |
| stok          | Integer   | Total stok             |
| stok_tersedia | Integer   | Stok tersedia          |
| cover         | Varchar   | Gambar cover           |
| deskripsi     | Text      | Deskripsi buku         |
| status        | Enum      | Tersedia / Tidak Aktif |
| created_at    | Timestamp | Tanggal dibuat         |
| updated_at    | Timestamp | Tanggal diperbarui     |

---

# 4.3 Data Transaksi

Data transaksi digunakan untuk mencatat seluruh aktivitas perpustakaan.

---

## A. Data Kunjungan

Data kunjungan mencatat seluruh aktivitas kunjungan anggota ke perpustakaan.

| Field      | Tipe Data | Keterangan                                                    |
| ---------- | --------- | ------------------------------------------------------------- |
| id         | BigInt    | Primary Key                                                   |
| anggota_id | BigInt    | Foreign Key                                                   |
| tanggal    | Date      | Tanggal kunjungan                                             |
| jam_masuk  | Time      | Jam masuk                                                     |
| tujuan     | Enum      | Membaca, Meminjam, Mengembalikan, Belajar, Referensi, Lainnya |
| catatan    | Text      | Opsional                                                      |
| created_at | Timestamp | Tanggal dibuat                                                |
| updated_at | Timestamp | Tanggal diperbarui                                            |

---

## B. Data Peminjaman

Mencatat transaksi peminjaman buku.

| Field               | Tipe Data | Keterangan                                                    |
| ------------------- | --------- | ------------------------------------------------------------- |
| id                  | BigInt    | Primary Key                                                   |
| anggota_id          | BigInt    | Foreign Key                                                   |
| petugas_id          | BigInt    | Foreign Key                                                   |
| tanggal_pinjam      | Date      | Tanggal pinjam                                                |
| tanggal_jatuh_tempo | Date      | Batas pengembalian                                            |
| status              | Enum      | Menunggu, Dipinjam, Dikembalikan, Terlambat, Penggantian Buku |
| created_at          | Timestamp | Tanggal dibuat                                                |
| updated_at          | Timestamp | Tanggal diperbarui                                            |

---

## C. Detail Peminjaman

Satu transaksi dapat terdiri dari beberapa buku.

| Field         | Tipe Data | Keterangan         |
| ------------- | --------- | ------------------ |
| id            | BigInt    | Primary Key        |
| peminjaman_id | BigInt    | Foreign Key        |
| buku_id       | BigInt    | Foreign Key        |
| jumlah        | Integer   | Jumlah buku        |
| created_at    | Timestamp | Tanggal dibuat     |
| updated_at    | Timestamp | Tanggal diperbarui |

---

## D. Data Pengembalian

Mencatat proses pengembalian buku.

| Field           | Tipe Data | Keterangan                              |
| --------------- | --------- | --------------------------------------- |
| id              | BigInt    | Primary Key                             |
| peminjaman_id   | BigInt    | Foreign Key                             |
| petugas_id      | BigInt    | Foreign Key                             |
| tanggal_kembali | Date      | Tanggal pengembalian                    |
| kondisi         | Enum      | Baik, Rusak Ringan, Rusak Berat, Hilang |
| catatan         | Text      | Catatan petugas                         |
| created_at      | Timestamp | Tanggal dibuat                          |
| updated_at      | Timestamp | Tanggal diperbarui                      |

---

## E. Data Penggantian Buku

Digunakan ketika buku yang dipinjam hilang dan harus diganti.

| Field           | Tipe Data | Keterangan                      |
| --------------- | --------- | ------------------------------- |
| id              | BigInt    | Primary Key                     |
| pengembalian_id | BigInt    | Foreign Key                     |
| buku_hilang     | Varchar   | Judul buku hilang               |
| buku_pengganti  | Varchar   | Judul buku pengganti            |
| tanggal_lapor   | Date      | Tanggal laporan                 |
| tanggal_selesai | Date      | Tanggal selesai                 |
| status          | Enum      | Menunggu, Diverifikasi, Selesai |
| catatan         | Text      | Catatan petugas                 |
| created_at      | Timestamp | Tanggal dibuat                  |
| updated_at      | Timestamp | Tanggal diperbarui              |

---

# 4.4 Data Pendukung

---

## A. Data Achievement

Menyimpan daftar achievement yang tersedia dalam sistem.

| Field      | Tipe Data | Keterangan             |
| ---------- | --------- | ---------------------- |
| id         | BigInt    | Primary Key            |
| nama       | Varchar   | Nama achievement       |
| deskripsi  | Text      | Penjelasan achievement |
| syarat     | Varchar   | Ketentuan memperoleh   |
| icon       | Varchar   | Ikon badge             |
| created_at | Timestamp | Tanggal dibuat         |
| updated_at | Timestamp | Tanggal diperbarui     |

---

## B. Data Achievement Pengguna

Mencatat achievement yang telah diperoleh anggota.

| Field           | Tipe Data | Keterangan         |
| --------------- | --------- | ------------------ |
| id              | BigInt    | Primary Key        |
| anggota_id      | BigInt    | Foreign Key        |
| achievement_id  | BigInt    | Foreign Key        |
| tanggal_didapat | Date      | Tanggal diperoleh  |
| created_at      | Timestamp | Tanggal dibuat     |
| updated_at      | Timestamp | Tanggal diperbarui |

---

## C. Data Leaderboard

Menyimpan peringkat anggota berdasarkan periode tertentu.

| Field      | Tipe Data | Keterangan                 |
| ---------- | --------- | -------------------------- |
| id         | BigInt    | Primary Key                |
| anggota_id | BigInt    | Foreign Key                |
| periode    | Enum      | Bulanan, Semester, Tahunan |
| total_poin | Integer   | Total poin                 |
| peringkat  | Integer   | Posisi peringkat           |
| created_at | Timestamp | Tanggal dibuat             |
| updated_at | Timestamp | Tanggal diperbarui         |

---

## D. Data Pengumuman

Menyimpan informasi atau pengumuman yang dibuat oleh petugas.

| Field            | Tipe Data | Keterangan          |
| ---------------- | --------- | ------------------- |
| id               | BigInt    | Primary Key         |
| petugas_id       | BigInt    | Foreign Key         |
| judul            | Varchar   | Judul pengumuman    |
| isi              | Text      | Isi pengumuman      |
| tanggal_publish  | Date      | Tanggal publikasi   |
| tanggal_berakhir | Date      | Tanggal berakhir    |
| status           | Enum      | Aktif / Tidak Aktif |
| created_at       | Timestamp | Tanggal dibuat      |
| updated_at       | Timestamp | Tanggal diperbarui  |

---

# 4.5 Relasi Data

Hubungan antar data dalam sistem adalah sebagai berikut.

* Satu **Petugas** dapat mengelola banyak transaksi peminjaman, pengembalian, serta membuat banyak pengumuman.
* Satu **Kategori Buku** memiliki banyak **Buku**.
* Satu **Anggota** memiliki banyak **Kunjungan**.
* Satu **Anggota** memiliki banyak **Peminjaman**.
* Satu **Peminjaman** memiliki banyak **Detail Peminjaman**.
* Satu **Buku** dapat muncul pada banyak **Detail Peminjaman**.
* Satu **Peminjaman** memiliki satu **Pengembalian**.
* Satu **Pengembalian** dapat memiliki satu **Penggantian Buku** apabila buku dinyatakan hilang.
* Satu **Anggota** dapat memperoleh banyak **Achievement** melalui tabel **Achievement Pengguna**.
* Satu **Achievement** dapat dimiliki oleh banyak **Anggota**.
* Satu **Anggota** memiliki data **Leaderboard** pada setiap periode.

---

# 4.6 Alur Data (Data Flow)

Secara umum alur data dalam sistem adalah sebagai berikut.

```text
Data Master
(Petugas, Anggota,
Kategori, Buku)
        │
        ▼
Data Transaksi
(Kunjungan,
Peminjaman,
Pengembalian,
Penggantian Buku)
        │
        ▼
Data Pendukung
(Achievement,
Leaderboard,
Pengumuman)
        │
        ▼
Laporan
```

---

# Penutup BAB IV

BAB IV menjelaskan kebutuhan data yang digunakan dalam Sistem Informasi Perpustakaan Acitya Wiguna. Seluruh entitas, atribut, serta hubungan antar data telah dirancang untuk mendukung proses operasional perpustakaan secara terintegrasi, mulai dari pengelolaan anggota, koleksi buku, transaksi peminjaman dan pengembalian, pencatatan kunjungan, hingga fitur pendukung seperti achievement, leaderboard, dan pengumuman.

Struktur data yang dirancang pada bab ini menjadi dasar dalam pembuatan basis data, Entity Relationship Diagram (ERD), relasi tabel, serta implementasi model pada proses pengembangan aplikasi. Dengan perancangan data yang terstruktur, sistem diharapkan mampu menyimpan, mengelola, dan menampilkan informasi secara akurat, konsisten, serta mudah dikembangkan di masa mendatang.

Pembahasan selanjutnya akan berfokus pada **BAB V – Non-Functional Requirements**, yang menjelaskan kebutuhan nonfungsional sistem, seperti performa, keamanan, kompatibilitas, keandalan, kemudahan penggunaan, serta spesifikasi teknis yang harus dipenuhi agar aplikasi dapat berjalan dengan baik.

---

# BAB V

# Non-Functional Requirements

---

# 5.1 Gambaran Umum

Non-Functional Requirements merupakan kebutuhan yang menjelaskan kualitas sistem yang harus dipenuhi agar Sistem Informasi Perpustakaan Acitya Wiguna dapat berjalan secara optimal. Berbeda dengan Functional Requirements yang berfokus pada fitur, kebutuhan nonfungsional menitikberatkan pada aspek performa, keamanan, keandalan, kemudahan penggunaan, kompatibilitas, dan kemampuan sistem untuk dikembangkan di masa mendatang.

Seluruh kebutuhan pada bab ini menjadi acuan dalam proses implementasi agar sistem tidak hanya berfungsi sesuai kebutuhan, tetapi juga memberikan pengalaman penggunaan yang baik bagi seluruh pengguna.

---

# 5.2 Performance Requirements

Sistem harus memiliki performa yang baik agar seluruh aktivitas perpustakaan dapat dilakukan secara cepat dan efisien.

## Kebutuhan Performa

* Proses login maksimal 3 detik.
* Pencarian buku maksimal 2 detik.
* Dashboard dapat dimuat dengan cepat.
* Penyimpanan data transaksi berlangsung secara efisien.
* Sistem mampu melayani beberapa pengguna secara bersamaan tanpa penurunan performa yang signifikan.
* Penggunaan memori dan sumber daya server harus efisien.

---

# 5.3 Security Requirements

Keamanan sistem diperlukan untuk melindungi data perpustakaan dan informasi pengguna.

## Kebutuhan Keamanan

* Seluruh pengguna wajib login menggunakan akun masing-masing.
* Password disimpan dalam bentuk terenkripsi (hashed).
* Hak akses dibatasi menggunakan Role-Based Access Control (RBAC).
* Hanya petugas yang dapat mengakses fitur administrasi.
* Sistem mencatat aktivitas penting seperti login, peminjaman, pengembalian, dan perubahan data.
* Backup database dilakukan secara berkala.
* Sistem melakukan validasi seluruh data yang diinput pengguna.

---

# 5.4 Usability Requirements

Sistem harus mudah digunakan oleh petugas, siswa, guru, maupun karyawan tanpa memerlukan pelatihan khusus.

## Kebutuhan Usability

* Antarmuka sederhana dan mudah dipahami.
* Navigasi konsisten pada seluruh halaman.
* Informasi penting mudah ditemukan.
* Formulir dilengkapi validasi yang jelas.
* Pesan kesalahan ditampilkan menggunakan bahasa yang mudah dipahami.
* Desain responsif sehingga nyaman digunakan pada berbagai ukuran layar.

---

# 5.5 Compatibility Requirements

Sistem harus dapat digunakan pada berbagai perangkat dan browser.

## Perangkat

* Desktop
* Laptop
* Tablet
* Smartphone

## Browser

* Google Chrome
* Mozilla Firefox
* Microsoft Edge
* Safari

---

# 5.6 Reliability Requirements

Sistem harus mampu berjalan secara stabil selama digunakan.

## Kebutuhan Reliability

* Sistem tetap dapat digunakan selama jam operasional perpustakaan.
* Risiko kegagalan sistem diminimalkan.
* Riwayat transaksi tidak hilang.
* Backup dapat digunakan untuk proses pemulihan data.
* Seluruh transaksi tersimpan secara konsisten.

---

# 5.7 Availability Requirements

Sistem harus tersedia ketika dibutuhkan oleh pengguna.

## Kebutuhan Availability

* Sistem dapat diakses selama perpustakaan beroperasi.
* Katalog buku dapat diakses kapan saja.
* Dashboard tersedia sesuai hak akses pengguna.
* Pemeliharaan sistem dilakukan di luar jam operasional apabila memungkinkan.

---

# 5.8 Scalability Requirements

Sistem harus mudah dikembangkan apabila kebutuhan perpustakaan meningkat.

## Kebutuhan Scalability

* Mendukung penambahan anggota baru.
* Mendukung penambahan koleksi buku.
* Mendukung penambahan fitur baru.
* Struktur database mudah dikembangkan.
* Dapat diintegrasikan dengan sistem sekolah pada masa mendatang.

---

# 5.9 Maintainability Requirements

Sistem harus mudah dipelihara agar proses pengembangan berikutnya lebih efisien.

## Kebutuhan Maintainability

* Struktur kode mengikuti standar pengembangan.
* Dokumentasi sistem tersedia.
* Database memiliki struktur yang jelas.
* Perubahan fitur tidak memengaruhi fungsi utama.
* Perbaikan bug dapat dilakukan dengan mudah.

---

# 5.10 Portability Requirements

Sistem harus dapat dijalankan pada berbagai lingkungan tanpa perubahan besar.

## Kebutuhan Portability

* Mendukung sistem operasi Windows, Linux, dan macOS.
* Dapat dipindahkan ke server lain apabila diperlukan.
* Mendukung berbagai ukuran layar melalui desain responsif.

---

# 5.11 Technology Requirements

Teknologi yang direkomendasikan dalam pengembangan sistem.

## Frontend

* HTML5
* CSS3
* JavaScript
* Bootstrap 5 atau Tailwind CSS

## Backend

* PHP 8.x
* Laravel Framework

## Database

* MySQL

## Web Server

* Apache
* Nginx

## Version Control

* Git
* GitHub

---

# 5.12 Hardware Requirements

## Server

| Komponen  | Minimum    |
| --------- | ---------- |
| Processor | Dual Core  |
| RAM       | 4 GB       |
| Storage   | 100 GB SSD |
| Internet  | Stabil     |

## Client

| Komponen  | Minimum        |
| --------- | -------------- |
| Processor | Dual Core      |
| RAM       | 2 GB           |
| Browser   | Browser modern |
| Resolusi  | 1366 × 768    |

---

# 5.13 Software Requirements

## Server

* Windows Server atau Linux
* PHP 8.x
* MySQL
* Apache atau Nginx
* Composer

## Client

* Google Chrome
* Mozilla Firefox
* Microsoft Edge
* Safari

---

# 5.14 Backup and Recovery Requirements

Untuk menjaga keamanan data, sistem harus menyediakan mekanisme pencadangan (backup) dan pemulihan (restore) database.

## Kebutuhan

* Petugas dapat melakukan backup database secara manual.
* Sistem dapat melakukan restore menggunakan file backup yang valid.
* Riwayat backup disimpan sebagai dokumentasi.
* File backup dapat diunduh dan disimpan di media penyimpanan lain.
* Backup dilakukan secara berkala sesuai kebutuhan perpustakaan.

---

# 5.15 Accessibility Requirements

Sistem harus dapat digunakan oleh seluruh pengguna dengan mudah.

## Kebutuhan

* Ukuran teks mudah dibaca.
* Kontras warna antarmuka jelas.
* Tombol memiliki ukuran yang cukup besar.
* Ikon disertai keterangan.
* Tata letak konsisten pada setiap halaman.

---

# Penutup BAB V

BAB V menjelaskan kebutuhan nonfungsional yang harus dipenuhi oleh Sistem Informasi Perpustakaan Acitya Wiguna agar mampu memberikan kualitas layanan yang baik. Aspek yang dibahas meliputi performa, keamanan, kemudahan penggunaan, kompatibilitas, keandalan, ketersediaan, skalabilitas, kemudahan pemeliharaan, spesifikasi teknologi, perangkat keras, perangkat lunak, hingga mekanisme backup dan aksesibilitas sistem.

Kebutuhan nonfungsional tersebut menjadi pedoman dalam proses pengembangan agar aplikasi tidak hanya memenuhi kebutuhan fungsional, tetapi juga mampu beroperasi secara stabil, aman, responsif, dan mudah dikembangkan sesuai kebutuhan perpustakaan di masa mendatang.

Pembahasan selanjutnya akan berfokus pada **BAB VI – System Flow & Use Case**, yang menjelaskan alur kerja sistem, interaksi setiap jenis pengguna dengan aplikasi, serta proses bisnis utama yang akan diimplementasikan selama pengembangan.

---

# BAB VI

# System Flow & Use Case

---

# 6.1 Gambaran Umum

System Flow menjelaskan alur kerja Sistem Informasi Perpustakaan Acitya Wiguna mulai dari pengguna melakukan login hingga seluruh proses perpustakaan selesai dilakukan. Alur ini menggambarkan bagaimana setiap pengguna berinteraksi dengan sistem sesuai hak akses yang dimiliki.

Selain itu, pada bab ini juga dijelaskan Use Case yang menunjukkan hubungan antara aktor dengan fitur-fitur yang tersedia di dalam sistem.

---

# 6.2 Aktor Sistem

Sistem memiliki empat jenis aktor utama.

| Aktor                | Deskripsi                                |
| -------------------- | ---------------------------------------- |
| Petugas Perpustakaan | Mengelola seluruh aktivitas perpustakaan |
| Siswa                | Menggunakan layanan perpustakaan         |
| Guru                 | Menggunakan layanan perpustakaan         |
| Karyawan             | Menggunakan layanan perpustakaan         |

---

# 6.3 Use Case Petugas

Petugas memiliki hak akses penuh terhadap sistem.

### Use Case

* Login
* Mengelola Profil
* Mengelola Buku
* Mengelola Kategori Buku
* Mengelola Data Anggota
* Melihat Buku Kunjungan
* Mengonfirmasi Peminjaman
* Mengonfirmasi Pengembalian
* Mengelola Buku Hilang
* Mengelola Achievement
* Melihat Leaderboard
* Mengelola Pengumuman
* Melihat Laporan
* Backup Database
* Restore Database
* Logout

---

## Alur Petugas

```text
Login
   │
   ▼
Dashboard
   │
   ├── Kelola Buku
   ├── Kelola Kategori
   ├── Kelola Anggota
   ├── Buku Kunjungan
   ├── Konfirmasi Peminjaman
   ├── Konfirmasi Pengembalian
   ├── Kelola Buku Hilang
   ├── Achievement Monitoring
   ├── Leaderboard
   ├── Pengumuman
   ├── Laporan
   ├── Backup Database
   └── Logout
```

---

# 6.4 Use Case Siswa

Siswa menggunakan sistem sebagai anggota perpustakaan.

### Use Case

* Login
* Mengelola Profil
* Melihat Dashboard
* Mengisi Buku Kunjungan
* Mencari Buku
* Melihat Detail Buku
* Mengajukan Peminjaman
* Melihat Status Peminjaman
* Mengembalikan Buku
* Melihat Riwayat Peminjaman
* Melihat Achievement
* Melihat Leaderboard
* Melihat Pengumuman
* Melihat Notifikasi
* Logout

---

## Alur Siswa

```text
Login
   │
   ▼
Dashboard
   │
   ├── Isi Buku Kunjungan
   ├── Cari Buku
   ├── Detail Buku
   ├── Ajukan Peminjaman
   ├── Status Peminjaman
   ├── Riwayat
   ├── Achievement
   ├── Leaderboard
   ├── Pengumuman
   ├── Notifikasi
   └── Logout
```

---

# 6.5 Use Case Guru/Karyawan

Guru dan karyawan memiliki fitur yang hampir sama dengan siswa, namun tidak menggunakan fitur achievement dan leaderboard.

### Use Case

* Login
* Mengelola Profil
* Melihat Dashboard
* Mengisi Buku Kunjungan
* Mencari Buku
* Melihat Detail Buku
* Mengajukan Peminjaman
* Mengembalikan Buku
* Melihat Riwayat Peminjaman
* Melihat Pengumuman
* Melihat Notifikasi
* Logout

---

## Alur Guru/Karyawan

```text
Login
   │
   ▼
Dashboard
   │
   ├── Isi Buku Kunjungan
   ├── Cari Buku
   ├── Detail Buku
   ├── Ajukan Peminjaman
   ├── Riwayat
   ├── Pengumuman
   ├── Notifikasi
   └── Logout
```

---

# 6.6 Use Case Diagram (Deskripsi)

Use Case Diagram menggambarkan hubungan antara aktor dengan fitur yang tersedia pada sistem.

### Petugas

Berinteraksi dengan seluruh fitur administrasi seperti pengelolaan buku, anggota, transaksi, laporan, pengumuman, serta backup database.

### Siswa

Berinteraksi dengan fitur katalog buku, buku kunjungan, peminjaman, pengembalian, riwayat, achievement, leaderboard, notifikasi, dan pengumuman.

### Guru/Karyawan

Berinteraksi dengan fitur katalog buku, buku kunjungan, peminjaman, pengembalian, riwayat, notifikasi, dan pengumuman.

---

# 6.7 Business Process

Proses bisnis utama pada sistem terdiri dari beberapa alur.

## A. Proses Login

```text
Pengguna membuka website
        │
        ▼
Memasukkan akun
        │
        ▼
Validasi data
        │
   ┌────┴────┐
   │         │
Valid      Tidak Valid
   │         │
   ▼         ▼
Dashboard  Pesan Error
```

---

## B. Proses Peminjaman Buku

```text
Cari Buku
     │
     ▼
Lihat Detail
     │
     ▼
Ajukan Peminjaman
     │
     ▼
Petugas Memverifikasi
     │
     ▼
Status Dipinjam
     │
     ▼
Stok Berkurang
```

---

## C. Proses Pengembalian Buku

```text
Pengguna Mengembalikan Buku
           │
           ▼
Petugas Memeriksa Buku
           │
     ┌─────┴─────┐
     │           │
  Kondisi Baik  Hilang/Rusak
     │           │
     ▼           ▼
Status Selesai  Penggantian Buku
```

---

## D. Proses Achievement

```text
Pengguna Melakukan Aktivitas
            │
            ▼
Sistem Menghitung Aktivitas
            │
            ▼
Memenuhi Syarat?
      │
 ┌────┴────┐
 │         │
Tidak      Ya
 │         │
 ▼         ▼
Selesai  Achievement Diberikan
          │
          ▼
      Notifikasi
```

---

## E. Proses Leaderboard

```text
Aktivitas Pengguna
        │
        ▼
Perhitungan Poin
        │
        ▼
Update Ranking
        │
        ▼
Leaderboard Ditampilkan
```

---

# Penutup BAB VI

BAB VI menjelaskan alur kerja sistem dan interaksi setiap aktor dengan fitur yang tersedia pada Sistem Informasi Perpustakaan Acitya Wiguna. Melalui System Flow dan Use Case, proses bisnis utama dapat dipahami dengan lebih jelas sehingga memudahkan tahap perancangan diagram UML, implementasi logika sistem, dan pengembangan aplikasi.

Pembahasan selanjutnya akan berfokus pada **BAB VII – Database Design & Entity Relationship Diagram (ERD)**, yang menjelaskan struktur tabel, relasi antar entitas, serta rancangan basis data yang akan digunakan dalam pengembangan sistem.

---

# BAB VII

# Database Design & Entity Relationship Diagram (ERD)

---

# 7.1 Gambaran Umum

Database merupakan komponen utama dalam Sistem Informasi Perpustakaan Acitya Wiguna yang berfungsi untuk menyimpan seluruh data secara terstruktur dan saling terhubung. Perancangan database dilakukan agar setiap proses bisnis, seperti pengelolaan anggota, koleksi buku, transaksi perpustakaan, pencatatan kunjungan, hingga penyusunan laporan dapat berjalan secara efektif dan konsisten.

Struktur database dirancang menggunakan model relasional sehingga memudahkan proses pengelolaan data, menjaga integritas data, serta mendukung pengembangan sistem di masa mendatang.

---

# 7.2 Entity Relationship Diagram (ERD)

Entity Relationship Diagram (ERD) digunakan untuk menggambarkan hubungan antar entitas dalam database.

Entitas utama yang digunakan pada sistem adalah sebagai berikut.

| No | Entitas              | Fungsi                                       |
| -- | -------------------- | -------------------------------------------- |
| 1  | Petugas              | Menyimpan data administrator sistem          |
| 2  | Anggota              | Menyimpan data siswa, guru, dan karyawan     |
| 3  | Kategori             | Menyimpan kategori buku                      |
| 4  | Buku                 | Menyimpan data koleksi buku                  |
| 5  | Kunjungan            | Menyimpan data kunjungan perpustakaan        |
| 6  | Peminjaman           | Menyimpan transaksi peminjaman               |
| 7  | Detail Peminjaman    | Menyimpan daftar buku pada setiap transaksi  |
| 8  | Pengembalian         | Menyimpan transaksi pengembalian             |
| 9  | Penggantian Buku     | Menyimpan data penggantian buku hilang       |
| 10 | Achievement          | Menyimpan daftar achievement                 |
| 11 | Achievement Pengguna | Menyimpan achievement yang diperoleh anggota |
| 12 | Leaderboard          | Menyimpan data peringkat pengguna            |
| 13 | Pengumuman           | Menyimpan informasi dari petugas             |

---

# 7.3 Relasi Antar Entitas

Hubungan antar entitas dijelaskan sebagai berikut.

| Entitas      | Relasi | Entitas                                    |
| ------------ | ------ | ------------------------------------------ |
| Kategori     | 1 : M  | Buku                                       |
| Anggota      | 1 : M  | Kunjungan                                  |
| Anggota      | 1 : M  | Peminjaman                                 |
| Petugas      | 1 : M  | Peminjaman                                 |
| Peminjaman   | 1 : M  | Detail Peminjaman                          |
| Buku         | 1 : M  | Detail Peminjaman                          |
| Peminjaman   | 1 : 1  | Pengembalian                               |
| Petugas      | 1 : M  | Pengembalian                               |
| Pengembalian | 1 : 1  | Penggantian Buku                           |
| Anggota      | M : N  | Achievement (melalui Achievement Pengguna) |
| Anggota      | 1 : M  | Leaderboard                                |
| Petugas      | 1 : M  | Pengumuman                                 |

---

# 7.4 Struktur Relasi Database

```text
Petugas
   │
   ├───────────────┐
   │               │
   ▼               ▼
Peminjaman     Pengumuman
   │
   ▼
Pengembalian
   │
   ▼
Penggantian Buku

Kategori
   │
   ▼
Buku
   │
   ▼
Detail Peminjaman
   ▲
   │
Peminjaman
   ▲
   │
Anggota
   │
   ├────────────┐
   │            │
   ▼            ▼
Kunjungan   Achievement Pengguna
                 │
                 ▼
           Achievement

Anggota
   │
   ▼
Leaderboard
```

---

# 7.5 Kardinalitas

Hubungan antar tabel menggunakan beberapa jenis kardinalitas.

## One to Many (1:M)

* Satu kategori memiliki banyak buku.
* Satu anggota memiliki banyak kunjungan.
* Satu anggota memiliki banyak peminjaman.
* Satu petugas menangani banyak peminjaman.
* Satu peminjaman memiliki banyak detail peminjaman.
* Satu buku dapat muncul pada banyak detail peminjaman.
* Satu petugas membuat banyak pengumuman.

---

## One to One (1:1)

* Satu transaksi peminjaman memiliki satu transaksi pengembalian.
* Satu transaksi pengembalian dapat memiliki satu data penggantian buku.

---

## Many to Many (M:N)

Hubungan antara anggota dan achievement menggunakan tabel perantara (Achievement Pengguna).

```text
Anggota
    │
    ▼
Achievement Pengguna
    ▲
    │
Achievement
```

---

# 7.6 Data Dictionary

## Tabel Petugas

Fungsi:
Menyimpan akun administrator perpustakaan.

Primary Key:

* id

Foreign Key:

* Tidak ada

---

## Tabel Anggota

Fungsi:
Menyimpan data seluruh pengguna perpustakaan.

Primary Key:

* id

Foreign Key:

* Tidak ada

---

## Tabel Buku

Fungsi:
Menyimpan koleksi buku.

Primary Key:

* id

Foreign Key:

* kategori_id

---

## Tabel Kategori

Fungsi:
Mengelompokkan buku berdasarkan klasifikasi DDC.

Primary Key:

* id

Foreign Key:

* Tidak ada

---

## Tabel Kunjungan

Fungsi:
Mencatat seluruh aktivitas kunjungan anggota.

Primary Key:

* id

Foreign Key:

* anggota_id

---

## Tabel Peminjaman

Fungsi:
Menyimpan transaksi peminjaman buku.

Primary Key:

* id

Foreign Key:

* anggota_id
* petugas_id

---

## Tabel Detail Peminjaman

Fungsi:
Menyimpan daftar buku dalam satu transaksi.

Primary Key:

* id

Foreign Key:

* peminjaman_id
* buku_id

---

## Tabel Pengembalian

Fungsi:
Mencatat transaksi pengembalian buku.

Primary Key:

* id

Foreign Key:

* peminjaman_id
* petugas_id

---

## Tabel Penggantian Buku

Fungsi:
Menyimpan data penggantian buku yang hilang.

Primary Key:

* id

Foreign Key:

* pengembalian_id

---

## Tabel Achievement

Fungsi:
Menyimpan daftar achievement.

Primary Key:

* id

Foreign Key:

* Tidak ada

---

## Tabel Achievement Pengguna

Fungsi:
Mencatat achievement yang diperoleh anggota.

Primary Key:

* id

Foreign Key:

* anggota_id
* achievement_id

---

## Tabel Leaderboard

Fungsi:
Menyimpan data peringkat anggota.

Primary Key:

* id

Foreign Key:

* anggota_id

---

## Tabel Pengumuman

Fungsi:
Menyimpan informasi dari petugas.

Primary Key:

* id

Foreign Key:

* petugas_id

---

# 7.7 Normalisasi Database

Perancangan database telah memenuhi prinsip normalisasi hingga Third Normal Form (3NF).

### First Normal Form (1NF)

* Seluruh atribut bernilai atomik.
* Tidak terdapat data berulang dalam satu kolom.

### Second Normal Form (2NF)

* Seluruh atribut non-key bergantung sepenuhnya pada Primary Key.

### Third Normal Form (3NF)

* Tidak terdapat ketergantungan transitif antar atribut non-key.
* Setiap tabel hanya menyimpan data sesuai fungsinya.

---

# Penutup BAB VII

BAB VII menjelaskan rancangan basis data yang digunakan dalam Sistem Informasi Perpustakaan Acitya Wiguna, meliputi entitas, relasi antar tabel, kardinalitas, struktur relasi, data dictionary, dan normalisasi database. Perancangan ini menjadi dasar dalam implementasi database serta memudahkan proses pengembangan aplikasi menggunakan framework Laravel dan sistem manajemen basis data MySQL.

Pembahasan selanjutnya akan berfokus pada **BAB VIII – Implementation Roadmap & MVP**, yang menjelaskan tahapan pengembangan sistem, prioritas fitur, serta rencana implementasi aplikasi mulai dari versi awal (Minimum Viable Product) hingga pengembangan lanjutan.

---

# BAB VIII

# Implementation Roadmap & Minimum Viable Product (MVP)

---

# 8.1 Gambaran Umum

Tahapan implementasi merupakan rencana pengembangan Sistem Informasi Perpustakaan Acitya Wiguna secara bertahap. Pengembangan dilakukan menggunakan pendekatan Minimum Viable Product (MVP), yaitu membangun fitur-fitur utama terlebih dahulu agar sistem dapat digunakan secepat mungkin. Setelah versi awal selesai, pengembangan dilanjutkan dengan penambahan fitur-fitur pendukung sesuai kebutuhan perpustakaan.

---

# 8.2 Tujuan MVP

Minimum Viable Product (MVP) bertujuan menghasilkan versi awal aplikasi yang telah memiliki fungsi utama sehingga dapat langsung digunakan oleh petugas perpustakaan dan anggota.

Tujuan MVP meliputi:

* Mempermudah pengelolaan data perpustakaan.
* Mempercepat proses digitalisasi.
* Mengurangi pencatatan manual.
* Menyediakan sistem yang stabil sebagai dasar pengembangan berikutnya.
* Memungkinkan evaluasi sistem sebelum penambahan fitur lanjutan.

---

# 8.3 Prioritas Pengembangan

Pengembangan sistem dibagi menjadi beberapa tahap berdasarkan tingkat prioritas.

## Tahap 1 – MVP

Fitur yang wajib tersedia pada versi awal.

| No | Fitur                   | Prioritas |
| -- | ----------------------- | --------- |
| 1  | Login Multi Role        | Tinggi    |
| 2  | Dashboard               | Tinggi    |
| 3  | Manajemen Buku          | Tinggi    |
| 4  | Manajemen Kategori      | Tinggi    |
| 5  | Manajemen Anggota       | Tinggi    |
| 6  | Katalog Buku            | Tinggi    |
| 7  | Buku Kunjungan Digital  | Tinggi    |
| 8  | Peminjaman Buku         | Tinggi    |
| 9  | Pengembalian Buku       | Tinggi    |
| 10 | Penggantian Buku Hilang | Tinggi    |
| 11 | Riwayat Peminjaman      | Tinggi    |
| 12 | Pengumuman              | Sedang    |
| 13 | Laporan                 | Tinggi    |

---

## Tahap 2 – Pengembangan Lanjutan

Fitur yang dapat ditambahkan setelah MVP selesai.

| No | Fitur                                  |
| -- | -------------------------------------- |
| 1  | Achievement Otomatis                   |
| 2  | Leaderboard                            |
| 3  | Notifikasi Otomatis                    |
| 4  | Monitoring Achievement                 |
| 5  | Statistik Dashboard yang lebih lengkap |
| 6  | Backup & Restore Database              |
| 7  | Status Alumni Otomatis                 |

---

## Tahap 3 – Future Development

Fitur yang dapat dikembangkan pada versi berikutnya.

| No | Fitur                                        |
| -- | -------------------------------------------- |
| 1  | QR Code untuk Buku                           |
| 2  | QR Code Buku Kunjungan                       |
| 3  | Scan Barcode Buku                            |
| 4  | Integrasi dengan Sistem Akademik Sekolah     |
| 5  | Digital Library (E-Book)                     |
| 6  | Rekomendasi Buku Berdasarkan Riwayat Membaca |
| 7  | Peminjaman Mandiri (Self Service)            |
| 8  | Dashboard Kepala Sekolah                     |

---

# 8.4 Roadmap Pengembangan

Tahapan pengembangan sistem direncanakan sebagai berikut.

| Tahap        | Fokus Pengembangan                               |
| ------------ | ------------------------------------------------ |
| Analisis     | Observasi, pengumpulan kebutuhan, penyusunan PRD |
| Perancangan  | UI/UX, Flowchart, Use Case, ERD, Database        |
| Pengembangan | Frontend dan Backend                             |
| Pengujian    | Black Box Testing dan User Acceptance Testing    |
| Implementasi | Deploy ke server sekolah                         |
| Pemeliharaan | Perbaikan bug dan pengembangan fitur             |

---

# 8.5 Metode Pengembangan

Pengembangan aplikasi menggunakan pendekatan **Waterfall**, karena kebutuhan sistem telah diperoleh melalui proses observasi dan analisis sehingga setiap tahap dapat dilakukan secara berurutan.

Tahapan metode Waterfall meliputi:

1. Analisis Kebutuhan
2. Perancangan Sistem
3. Implementasi
4. Pengujian
5. Deployment
6. Maintenance

---

# 8.6 Risiko Pengembangan

Beberapa risiko yang mungkin terjadi selama proses pengembangan beserta strategi penanganannya adalah sebagai berikut.

| Risiko               | Dampak                     | Mitigasi                                            |
| -------------------- | -------------------------- | --------------------------------------------------- |
| Perubahan kebutuhan  | Pengembangan tertunda      | Melakukan evaluasi kebutuhan sebelum implementasi   |
| Kesalahan input data | Data tidak akurat          | Menambahkan validasi pada setiap formulir           |
| Gangguan server      | Sistem tidak dapat diakses | Menyediakan backup database dan pemeliharaan server |
| Kehilangan data      | Operasional terganggu      | Backup data secara berkala                          |
| Bug pada aplikasi    | Fitur tidak berjalan       | Melakukan pengujian sebelum sistem digunakan        |

---

# 8.7 Kriteria Keberhasilan

Sistem dinyatakan berhasil apabila memenuhi kriteria berikut.

* Seluruh pengguna dapat login sesuai hak akses.
* Pengelolaan buku berjalan dengan baik.
* Pengelolaan anggota berjalan dengan baik.
* Peminjaman dan pengembalian tercatat dengan benar.
* Buku kunjungan digital dapat digunakan.
* Laporan dapat dibuat secara otomatis.
* Data tersimpan secara konsisten.
* Sistem berjalan dengan stabil pada perangkat yang digunakan perpustakaan.
* Pengguna dapat menggunakan sistem tanpa mengalami kesulitan berarti.

---

# Penutup BAB VIII

BAB VIII menjelaskan rencana implementasi Sistem Informasi Perpustakaan Acitya Wiguna mulai dari pengembangan versi awal (Minimum Viable Product), pengembangan lanjutan, hingga rencana pengembangan di masa mendatang. Penyusunan roadmap ini memberikan gambaran mengenai prioritas fitur, tahapan implementasi, metode pengembangan, serta indikator keberhasilan sistem.

Dengan adanya dokumen Product Requirements Document (PRD) yang lengkap, proses pengembangan aplikasi diharapkan dapat berjalan lebih terarah, sistematis, dan sesuai dengan kebutuhan Perpustakaan Acitya Wiguna SMK Negeri 1 Rembang Purbalingga.

---
