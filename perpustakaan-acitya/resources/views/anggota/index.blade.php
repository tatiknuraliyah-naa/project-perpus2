@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Manajemen pengguna</p><h1>Data Anggota</h1><p class="muted">Kelola data siswa, guru, dan karyawan perpustakaan.</p></div>
            <div class="page-actions"><a class="button button-secondary" href="{{ route('dashboard.petugas') }}">Dashboard</a><a class="button button-secondary" href="{{ route('anggota.import.create') }}">Import Excel</a><a class="button" href="{{ route('anggota.create') }}">Tambah anggota</a></div>
        </header>

        @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
        @if (session('import_summary'))
            @php($summary = session('import_summary'))
            <div class="alert alert-success">Total baris: {{ $summary['total'] }} · Berhasil: {{ $summary['success'] }} · Gagal: {{ $summary['failed'] }} · Duplikat: {{ $summary['duplicates'] }} · Dilewati: {{ $summary['skipped'] }}</div>
        @endif
        @if (session('import_failures'))
            <div class="alert alert-error"><strong>Data gagal diimport:</strong><ul>@foreach (session('import_failures') as $failure)<li>{{ $failure }}</li>@endforeach</ul></div>
        @endif

        <section class="content-card">
            <form method="GET" class="filter-form filter-form-wide">
                <input name="cari" value="{{ $search }}" placeholder="Nama, NIS/NISN, atau NIP" aria-label="Cari anggota">
                <select name="role" aria-label="Filter peran"><option value="">Semua peran</option>@foreach (['Siswa', 'Guru', 'Karyawan'] as $nilaiRole)<option value="{{ $nilaiRole }}" @selected($role === $nilaiRole)>{{ $nilaiRole }}</option>@endforeach</select>
                <select name="status" aria-label="Filter status"><option value="">Semua status</option>@foreach (['Aktif', 'Alumni', 'Nonaktif'] as $nilaiStatus)<option value="{{ $nilaiStatus }}" @selected($status === $nilaiStatus)>{{ $nilaiStatus }}</option>@endforeach</select>
                <button type="submit" class="button">Filter</button><a class="text-link" href="{{ route('anggota.index') }}">Reset</a>
            </form>
            <div class="table-wrap"><table><thead><tr><th>Anggota</th><th>Peran</th><th>Identitas</th><th>Status</th><th>Aktivitas</th><th>Aksi</th></tr></thead><tbody>
                @forelse ($anggota as $item)
                    <tr><td><strong>{{ $item->nama }}</strong><br><span class="table-note">{{ $item->email ?: 'Email belum diisi' }}</span></td><td>{{ $item->role }}</td><td>{{ $item->role === 'Siswa' ? $item->nis_nisn : $item->nip }}</td><td><span class="badge {{ $item->status === 'Aktif' ? 'badge-success' : 'badge-muted' }}">{{ $item->status }}</span></td><td>{{ $item->peminjaman_count }} peminjaman<br><span class="table-note">{{ $item->kunjungan_count }} kunjungan</span></td><td class="row-actions"><a class="text-link" href="{{ route('anggota.edit', $item) }}">Edit</a><form method="POST" action="{{ route('anggota.destroy', $item) }}" onsubmit="return confirm('Hapus data anggota ini?')">@csrf @method('DELETE')<button class="link-button" type="submit">Hapus</button></form></td></tr>
                @empty<tr><td colspan="6" class="empty-state">Belum ada anggota yang sesuai.</td></tr>@endforelse
            </tbody></table></div>
            {{ $anggota->links() }}
        </section>
    </main>
@endsection
