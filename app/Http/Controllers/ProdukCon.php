<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\View\View;

class ProdukCon extends Controller
{
    public function home(): View
    {
        // Load produk beserta relasi kategori & brand
        $produks = Produk::with(['kategori', 'brand'])->get();
        return view('index', compact('produks'));
    }
}
