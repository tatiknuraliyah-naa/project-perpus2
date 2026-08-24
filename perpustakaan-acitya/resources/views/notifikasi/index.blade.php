@extends('layouts.app')

@section('content')
    <main class="app-page">
        <header class="page-header">
            <h1>Notifikasi</h1>
        </header>

        <section class="content-card">
            @forelse ($notifikasi as $item)
                <article>
                    <strong>{{ $item->judul }}</strong>
                    <p>{{ $item->pesan }}</p>
                    <small class="muted">{{ $item->created_at->format('d M Y H:i') }}</small>

                    @if ($item->status_baca === 'Belum Dibaca')
                        <form method="POST" action="{{ route('notifikasi.read', $item) }}">
                            @csrf
                            <button class="link-button">Tandai sudah dibaca</button>
                        </form>
                    @endif
                </article>
                <hr>
            @empty
                <p class="empty-state">Tidak ada notifikasi.</p>
            @endforelse

            {{ $notifikasi->links() }}
        </section>
    </main>
@endsection
