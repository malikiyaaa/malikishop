<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // === USERS ===
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
        User::create([
            'name'     => 'Customer',
            'email'    => 'customer@example.com',
            'password' => Hash::make('password'),
            'role'     => 'customer',
        ]);

        // === KATEGORI ===
        $kategori = [
            ['id' => 'KAT001', 'nama_kategori' => 'Mesin'],
            ['id' => 'KAT002', 'nama_kategori' => 'Bodi'],
            ['id' => 'KAT003', 'nama_kategori' => 'Kelistrikan'],
            ['id' => 'KAT004', 'nama_kategori' => 'Kaki-Kaki'],
        ];
        foreach ($kategori as $k) Kategori::create($k);

        // === BRAND ===
        $brands = [
            ['id' => 'BRD001', 'nama_brand' => 'Toyota'],
            ['id' => 'BRD002', 'nama_brand' => 'Honda'],
            ['id' => 'BRD003', 'nama_brand' => 'Yamaha'],
        ];
        foreach ($brands as $b) Brand::create($b);

        // === PRODUK (SPAREPART) ===
        Produk::create([
            'kode_produk'    => 'SP001',
            'nama_produk'    => 'Filter Oli Toyota Avanza',
            'tipe_kendaraan' => 'Mobil',
            'kategori_id'    => 'KAT001',
            'brand_id'       => 'BRD001',
            'harga'          => 45000,
            'stok'           => 50,
            'gambar'         => 'https://via.placeholder.com/400x300?text=Filter+Oli',
        ]);
        Produk::create([
            'kode_produk'    => 'SP002',
            'nama_produk'    => 'Kampas Rem Honda Beat',
            'tipe_kendaraan' => 'Motor',
            'kategori_id'    => 'KAT004',
            'brand_id'       => 'BRD002',
            'harga'          => 85000,
            'stok'           => 30,
            'gambar'         => 'https://via.placeholder.com/400x300?text=Kampas+Rem',
        ]);
    }
}
