@extends('layouts.app')

@section('content')
    <main class="auth-page">
        <section class="auth-card">
            <p class="eyebrow">Kunjungan Digital</p>
            <h1>{{ $title }}</h1>
            <p class="muted">{{ $message }}</p>
            <a class="button" href="{{ route('landing') }}">Kembali ke Beranda</a>
        </section>
    </main>
@endsection
