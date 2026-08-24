@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <h1>Manajemen Petugas</h1>
            <a class="button" href="{{ route('petugas.create') }}">Tambah</a>
        </header>

        <section class="content-card">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petugas as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->level }}</td>
                                <td>{{ $item->status }}</td>
                                <td><a class="text-link" href="{{ route('petugas.edit', $item) }}">Ubah</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $petugas->links() }}
        </section>
    </main>
@endsection
