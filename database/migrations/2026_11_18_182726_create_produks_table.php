<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->string('kode_produk')->primary();  // PK, e.g. 'SP001'
            $table->string('nama_produk');
            $table->string('tipe_kendaraan');          // e.g. 'Motor', 'Mobil'
            $table->string('kategori_id');             // FK → kategoris.id
            $table->bigInteger('harga');
            $table->integer('stok');
            $table->string('gambar')->nullable();
            $table->string('brand_id');                // FK → brands.id
            $table->timestamps();

            $table->foreign('kategori_id')
                   ->references('id')->on('kategoris');
            $table->foreign('brand_id')
                   ->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
