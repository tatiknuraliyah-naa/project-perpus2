<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Notifikasi;
use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(): View { $pengumuman=Pengumuman::with('petugas:id,nama')->latest('tanggal_publish')->paginate(10); return view('pengumuman.index',compact('pengumuman')); }
    public function create(): View { return view('pengumuman.form',['pengumuman'=>new Pengumuman]); }
    public function store(Request $request): RedirectResponse { $pengumuman=Pengumuman::create([...$this->data($request),'petugas_id'=>auth('petugas')->id()]); if($pengumuman->status==='Aktif' && $pengumuman->tanggal_publish->lte(today())) $this->notifyMembers($pengumuman); return redirect()->route('pengumuman.index')->with('success','Pengumuman diterbitkan.'); }
    public function edit(Pengumuman $pengumuman): View { return view('pengumuman.form',compact('pengumuman')); }
    public function update(Request $request,Pengumuman $pengumuman): RedirectResponse { $pengumuman->update($this->data($request)); return redirect()->route('pengumuman.index')->with('success','Pengumuman diperbarui.'); }
    public function destroy(Pengumuman $pengumuman): RedirectResponse { $pengumuman->delete(); return back()->with('success','Pengumuman diarsipkan.'); }
    private function data(Request $request): array { return $request->validate(['judul'=>['required','string','max:255'],'isi'=>['required','string'],'tanggal_publish'=>['required','date'],'tanggal_berakhir'=>['nullable','date','after_or_equal:tanggal_publish'],'status'=>['required',Rule::in(['Aktif','Tidak Aktif'])]]); }
    private function notifyMembers(Pengumuman $pengumuman): void { Anggota::query()->select('id')->chunkById(200, function ($anggota) use ($pengumuman) { foreach($anggota as $item) Notifikasi::create(['anggota_id'=>$item->id,'judul'=>'Pengumuman baru: '.$pengumuman->judul,'pesan'=>str($pengumuman->isi)->limit(160),'tipe'=>'Pengumuman','tautan'=>route('pengumuman.index')]); }); }
}
