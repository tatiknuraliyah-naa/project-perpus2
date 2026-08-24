<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('cari')->trim()->value();

        $kategori = Kategori::query()
            ->withCount('buku')
            ->when($search, fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('kode_ddc', 'like', "%{$search}%")
                    ->orWhere('nama_kategori', 'like', "%{$search}%");
            }))
            ->orderBy('kode_ddc')
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('kategori', 'search'));
    }

    public function create(): View
    {
        return view('kategori.form', ['kategori' => new Kategori]);
    }

    public function store(StoreKategoriRequest $request): RedirectResponse
    {
        Kategori::create($request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori): View
    {
        return view('kategori.form', compact('kategori'));
    }

    public function update(UpdateKategoriRequest $request, Kategori $kategori): RedirectResponse
    {
        $kategori->update($request->validated());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        if ($kategori->buku()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data buku.');
        }

        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
