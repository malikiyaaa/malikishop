<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'kode_produk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_produk', 'nama_produk', 'tipe_kendaraan',
        'kategori_id', 'harga', 'stok', 'gambar', 'brand_id'
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    // Relasi ke Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    // Relasi ke Pembelian
    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'kode_produk', 'kode_produk');
    }
}
