g{{--
======================================================
Nama File : login.blade.php
Fungsi : Form login untuk Petugas, Siswa, Guru, dan Karyawan.
Bagian yang boleh diubah : Teks, label, warna, icon, dan layout.
Bagian yang harus berhati-hati : Nama input, action form, error, dan @csrf.
Bagian yang tidak boleh diubah : Method POST serta @csrf pada form login.
Risiko : Mengubah nama input atau CSRF dapat membuat login gagal.
======================================================
--}}
@extends('layouts.app')

@section('content')
    {{-- BOLEH DIUBAH: tampilan form dan informasi akun contoh. --}}
    <main class="auth-page">
        <section class="auth-card" aria-labelledby="login-title">
            <p class="eyebrow">SMK Negeri 1 Rembang Purbalingga</p>
            <h1 id="login-title">Perpustakaan Acitya Wiguna</h1>
            <p class="muted">Masuk menggunakan identitas resmi sekolah Anda.</p>
            @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
            {{-- JANGAN DIUBAH: form autentikasi membutuhkan POST dan CSRF. --}}
            <form method="POST" action="{{ route('login.store') }}" class="form-stack">
                @csrf
                <label for="role">Masuk sebagai</label>
                <select id="role" name="role" required>
                    <option value="Petugas" @selected(old('role') === 'Petugas')>Petugas</option><option value="Siswa" @selected(old('role') === 'Siswa')>Siswa</option><option value="Guru" @selected(old('role') === 'Guru')>Guru</option><option value="Karyawan" @selected(old('role') === 'Karyawan')>Karyawan</option>
                </select>
                <label for="identitas">NIP / NIS-NISN</label><input id="identitas" name="identitas" type="text" value="{{ old('identitas') }}" maxlength="30" required autofocus>
                <label for="password">Password</label><input id="password" name="password" type="password" required>
                @error('identitas') <p class="alert alert-error" role="alert">{{ $message }}</p> @enderror
                @error('role') <p class="alert alert-error" role="alert">{{ $message }}</p> @enderror
                <button type="submit">Masuk</button>
            </form>
            <p class="hint">Akun contoh: gunakan password <code>password</code> setelah menjalankan seeder.</p>
        </section>
    </main>
@endsection
