@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <div><p class="eyebrow">Import anggota</p><h1>Pratinjau &amp; Mapping Kolom</h1><p class="muted">File: {{ $fileName }}. Periksa mapping sebelum data disimpan.</p></div>
            <a class="button button-secondary" href="{{ route('anggota.import.create') }}">Ganti File</a>
        </header>

        <section class="content-card form-card">
            @if (session('error')) <div class="alert alert-error">{{ session('error') }}</div> @endif
            <p class="muted">Kolom yang tidak diperlukan boleh dibiarkan sebagai “Tidak digunakan”. Role akan dideteksi dari NIS/NISN atau NIP bila tidak dipetakan.</p>
            <form method="POST" action="{{ route('anggota.import.confirm') }}" class="form-stack">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-grid">
                    @foreach ($labels as $field => $label)
                        <div>
                            <label for="mapping_{{ $field }}">{{ $label }}</label>
                            <select id="mapping_{{ $field }}" name="mapping[{{ $field }}]">
                                <option value="">Tidak digunakan</option>
                                @foreach ($headers as $index => $header)
                                    <option value="{{ $index }}" @selected($mapping[$field] === $index)>{{ $header ?: 'Kolom '.($index + 1) }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>

                <div class="table-wrap"><table><thead><tr><th>Baris</th>@foreach ($labels as $label)<th>{{ $label }}</th>@endforeach</tr></thead><tbody>
                    @forelse ($previewRows as $row)
                        <tr><td>{{ $row['line'] }}</td>@foreach (array_keys($labels) as $field)<td>{{ $row['data'][$field] ?: '—' }}</td>@endforeach</tr>
                    @empty<tr><td colspan="10" class="empty-state">Tidak ada baris data untuk dipratinjau.</td></tr>@endforelse
                </tbody></table></div>
                <p class="table-note">Pratinjau mengikuti mapping otomatis awal. Mapping yang Anda ubah akan digunakan saat konfirmasi import.</p>
                <div class="page-actions"><button type="submit" class="button">Konfirmasi Import</button><a class="button button-secondary" href="{{ route('anggota.import.create') }}">Batal</a></div>
            </form>
        </section>
    </main>
@endsection
