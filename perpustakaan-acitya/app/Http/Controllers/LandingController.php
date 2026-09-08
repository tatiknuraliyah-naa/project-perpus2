<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $bukuPilihan = Buku::query()
            ->with('kategori')
            ->where('status', 'Tersedia')
            ->orderBy('judul')
            ->limit(4)
            ->get();

        return view('landing', compact('bukuPilihan'));
    }
}
