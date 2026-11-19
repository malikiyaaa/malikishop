<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembelianCon extends Controller
{
    /**
     * Riwayat pesanan milik user yang sedang login:
     * semua transaksi pembeliannya beserta status terkini.
     */
    public function riwayat()
    {
        $pembelians = Pembelian::with('produk')
            ->where('user_id', auth()->id())
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('riwayat', compact('pembelians'));
    }

    /**
     * Proses pembelian: stok otomatis berkurang sesuai jumlah yang dibeli.
     * Memakai DB transaction + lockForUpdate agar stok tidak bentrok
     * kalau ada dua pembeli bersamaan.
     */
    public function storeinput(Request $request)
    {
        $validated = $request->validate([
            'kode_produk' => 'required|exists:produks,kode_produk',
            'jumlah'      => 'required|integer|min:1',
        ]);

        $stokTersedia = 0;

        $pembelian = DB::transaction(function () use ($validated, &$stokTersedia) {
            // Kunci baris produk sampai transaksi selesai (mencegah race condition)
            $produk = Produk::where('kode_produk', $validated['kode_produk'])
                ->lockForUpdate()
                ->firstOrFail();

            $stokTersedia = $produk->stok;

            if ($produk->stok < $validated['jumlah']) {
                return null; // stok tidak cukup
            }

            // Stok berkurang sesuai jumlah yang dibeli
            $produk->decrement('stok', $validated['jumlah']);

            return Pembelian::create([
                'id_pembelian'      => 'TRX-' . Str::random(8),
                'user_id'           => auth()->id(),
                'kode_produk'       => $produk->kode_produk,
                'jumlah'            => $validated['jumlah'],
                'total_bayar'       => $produk->harga * $validated['jumlah'],
                'tanggal_transaksi' => now(),
                'status'            => 'Verifikasi',
            ]);
        });

        if ($pembelian === null) {
            return back()
                ->with('error', "Stok tidak cukup! Sisa stok hanya {$stokTersedia}.")
                ->withInput();
        }

        return back()->with(
            'success',
            "Pembelian berhasil! Pesanan {$pembelian->id_pembelian} sedang diverifikasi."
        );
    }
}
