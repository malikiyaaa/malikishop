@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold">Riwayat Pesanan</h2>
    <p class="text-gray-600 text-sm mt-1">
        Daftar semua pesanan Anda beserta statusnya.
    </p>
</div>

@if($pembelians->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Kode Transaksi</th>
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Total Bayar</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($pembelians as $pembelian)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $pembelian->id_pembelian }}</td>
                        <td class="px-4 py-3">
                            {{ $pembelian->produk->nama_produk ?? $pembelian->kode_produk }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $pembelian->tanggal_transaksi->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-3">{{ $pembelian->jumlah }}</td>
                        <td class="px-4 py-3 font-medium">
                            Rp {{ number_format($pembelian->total_bayar, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $warna = match($pembelian->status) {
                                    'Verifikasi' => 'bg-yellow-100 text-yellow-800',
                                    'Proses'     => 'bg-blue-100 text-blue-800',
                                    'Kirim'      => 'bg-indigo-100 text-indigo-800',
                                    'Sampai'     => 'bg-cyan-100 text-cyan-800',
                                    'Selesai'    => 'bg-green-100 text-green-800',
                                    default      => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $warna }}">
                                {{ $pembelian->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pembelians->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <p class="text-gray-500">Anda belum memiliki pesanan.</p>
        <a href="{{ route('homeproduk') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700">
            Mulai Belanja
        </a>
    </div>
@endif
@endsection
