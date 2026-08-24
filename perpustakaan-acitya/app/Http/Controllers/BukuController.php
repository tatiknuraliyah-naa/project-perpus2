<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function catalog(Request $request): View
    {
        $search = $request->string('cari')->trim()->value();
        $kategoriId = $request->integer('kategori_id');
        $jenis = $request->string('jenis')->value();
        $ketersediaan = $request->boolean('tersedia');

        $buku = Buku::query()
            ->with('kategori')
            ->where('status', 'Tersedia')
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('kode_buku', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('penerbit', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            }))
            ->when($kategoriId, fn ($query) => $query->where('kategori_id', $kategoriId))
            ->when(in_array($jenis, ['Umum', 'Paket'], true), fn ($query) => $query->where('jenis_buku', $jenis))
            ->when($ketersediaan, fn ($query) => $query->where('stok_tersedia', '>', 0))
            ->orderBy('judul')
            ->paginate(12)
            ->withQueryString();

        $kategori = $this->kategori();

        return view('katalog.index', compact('buku', 'kategori', 'search', 'kategoriId', 'jenis', 'ketersediaan'));
    }

    public function showCatalog(Buku $buku): View
    {
        abort_unless($buku->status === 'Tersedia', 404);

        return view('katalog.show', ['buku' => $buku->load('kategori')]);
    }

    public function index(Request $request): View
    {
        $search = $request->string('cari')->trim()->value();
        $kategoriId = $request->integer('kategori_id');
        $status = $request->string('status')->value();

        $buku = Buku::query()
            ->with('kategori')
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('kode_buku', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%");
            }))
            ->when($kategoriId, fn ($query) => $query->where('kategori_id', $kategoriId))
            ->when(in_array($status, ['Tersedia', 'Tidak Aktif'], true), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $kategori = Kategori::query()->orderBy('kode_ddc')->get(['id', 'kode_ddc', 'nama_kategori']);

        return view('buku.index', compact('buku', 'kategori', 'search', 'kategoriId', 'status'));
    }

    public function create(): View
    {
        return view('buku.form', ['buku' => new Buku, 'kategori' => $this->kategori()]);
    }

    public function store(StoreBukuRequest $request): RedirectResponse
    {
        $data = $request->safe()->except('cover');
        $data['cover'] = $request->file('cover')?->store('cover-buku', 'public');
        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku): View
    {
        return view('buku.form', ['buku' => $buku, 'kategori' => $this->kategori()]);
    }

    public function update(UpdateBukuRequest $request, Buku $buku): RedirectResponse
    {
        $data = $request->safe()->except('cover');

        if ($request->hasFile('cover')) {
            if ($buku->cover) {
                Storage::disk('public')->delete($buku->cover);
            }

            $data['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        if ($buku->detailPeminjaman()->exists()) {
            return back()->with('error', 'Buku tidak dapat dihapus karena sudah tercatat dalam transaksi peminjaman. Ubah statusnya menjadi Tidak Aktif agar riwayat tetap terjaga.');
        }

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus.');
    }

    private function kategori()
    {
        return Kategori::query()->orderBy('kode_ddc')->get(['id', 'kode_ddc', 'nama_kategori']);
    }
}
