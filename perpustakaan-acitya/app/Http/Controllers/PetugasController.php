<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Support\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PetugasController extends Controller
{
    public function index(Request $request): View { $cari=$request->string('cari')->trim()->value(); $petugas=Petugas::when($cari, fn($q)=>$q->where('nama','like',"%{$cari}%")->orWhere('nip','like',"%{$cari}%"))->orderBy('nama')->paginate(12)->withQueryString(); return view('petugas.index',compact('petugas','cari')); }
    public function create(): View { return view('petugas.form',['petugas'=>new Petugas]); }
    public function store(Request $request): RedirectResponse { $petugas=Petugas::create($this->validated($request)); ActivityLogger::log("Menambah petugas {$petugas->nama}",'Petugas'); return redirect()->route('petugas.index')->with('success','Akun petugas ditambahkan.'); }
    public function edit(Petugas $petugas): View { return view('petugas.form',compact('petugas')); }
    public function update(Request $request, Petugas $petugas): RedirectResponse { $data=$this->validated($request,$petugas); if(blank($data['password'] ?? null)) unset($data['password']); $petugas->update($data); ActivityLogger::log("Memperbarui petugas {$petugas->nama}",'Petugas'); return redirect()->route('petugas.index')->with('success','Akun petugas diperbarui.'); }
    public function destroy(Petugas $petugas): RedirectResponse { abort_if($petugas->is(auth('petugas')->user()), 422, 'Akun sendiri tidak dapat dihapus.'); $petugas->delete(); ActivityLogger::log("Menghapus petugas {$petugas->nama}",'Petugas'); return back()->with('success','Akun petugas diarsipkan.'); }
    private function validated(Request $request, ?Petugas $petugas=null): array { return $request->validate(['nip'=>['required','string','max:30',Rule::unique('petugas','nip')->ignore($petugas)],'nama'=>['required','string','max:150'],'username'=>['required','string','max:50',Rule::unique('petugas','username')->ignore($petugas)],'email'=>['nullable','email','max:150',Rule::unique('petugas','email')->ignore($petugas)],'no_hp'=>['nullable','string','max:20'],'level'=>['required',Rule::in(['Admin','Petugas'])],'status'=>['required',Rule::in(['Aktif','Nonaktif'])],'password'=>[$petugas?'nullable':'required','string','min:8','confirmed']]); }
}
