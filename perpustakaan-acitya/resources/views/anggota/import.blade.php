@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Manajemen pengguna</p><h1>Import Data Anggota</h1><p class="muted">Unggah data siswa, guru, atau karyawan dari Excel atau CSV.</p></div>
            <a class="button button-secondary" href="{{ route('anggota.index') }}">Kembali</a>
        </header>

        <section class="content-card form-card">
            @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
            <p class="muted">Template hanya contoh. Sistem mengenali header umum, dapat mengabaikan kolom tambahan, lalu memberi kesempatan untuk memeriksa mapping sebelum data disimpan. Mendukung XLSX, XLS, dan CSV hingga 5 MB.</p>
            <p><a class="button button-secondary" href="{{ route('anggota.import.template') }}">Download Contoh Template Excel</a></p>
            <form method="POST" action="{{ route('anggota.import.preview') }}" enctype="multipart/form-data" class="form-stack">
                @csrf
                <div><label for="file">File Excel/CSV</label><input id="file" name="file" type="file" accept=".xlsx,.xls,.csv" required>@error('file')<p class="field-error">{{ $message }}</p>@enderror</div>
                <div class="page-actions"><button type="submit" class="button">Lanjutkan ke Pratinjau</button><a class="button button-secondary" href="{{ route('anggota.index') }}">Batal</a></div>
            </form>
        </section>
    </main>
@endsection
