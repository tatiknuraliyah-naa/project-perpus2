<?php
namespace App\Http\Controllers;
use App\Models\LogAktivitas; use Illuminate\Http\Request; use Illuminate\View\View;
class LogAktivitasController extends Controller { public function index(Request $request): View { $cari=$request->string('cari')->trim()->value(); $log=LogAktivitas::with(['petugas:id,nama','anggota:id,nama'])->when($cari,fn($q)=>$q->where('aktivitas','like',"%{$cari}%")->orWhere('modul','like',"%{$cari}%"))->latest('created_at')->paginate(20)->withQueryString(); return view('log-aktivitas.index',compact('log','cari')); } }
