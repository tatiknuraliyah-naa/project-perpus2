@extends('layouts.app')
@section('content')
<main class="auth-page"><section class="auth-card"><p class="eyebrow">Kunjungan Digital</p><h1>Catat kunjungan</h1>@if($sudahMengisi)<p class="alert alert-error">Kunjungan Anda hari ini sudah tercatat.</p>@else<form class="form-stack" method="POST" action="{{ route('qr-kunjungan.record',$token) }}">@csrf<label>Tujuan<select name="tujuan"><option>Membaca</option><option>Meminjam</option><option>Mengembalikan</option><option>Belajar</option><option>Referensi</option><option>Lainnya</option></select></label><label>Catatan (opsional)<textarea name="catatan"></textarea></label><button>Catat kunjungan</button></form>@endif</section></main>
@endsection
