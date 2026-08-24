<?php

namespace App\Http\Controllers;
use App\Models\Notifikasi; use Illuminate\Http\RedirectResponse; use Illuminate\View\View;
class NotifikasiController extends Controller { public function index(): View { $isPetugas=auth('petugas')->check(); $notifikasi=Notifikasi::where($isPetugas?'petugas_id':'anggota_id',auth($isPetugas?'petugas':'anggota')->id())->latest()->paginate(15); return view('notifikasi.index',compact('notifikasi')); } public function read(Notifikasi $notifikasi): RedirectResponse { abort_unless($notifikasi->{auth('petugas')->check()?'petugas_id':'anggota_id'}===auth(auth('petugas')->check()?'petugas':'anggota')->id(),403); $notifikasi->update(['status_baca'=>'Sudah Dibaca']); return $notifikasi->tautan?redirect($notifikasi->tautan):back(); } }
