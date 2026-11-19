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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->string('id_pembelian')->primary(); // PK, e.g. 'TRX001'
            $table->unsignedBigInteger('user_id');     // FK → users.id
            $table->string('kode_produk');             // FK → produks.kode_produk
            $table->integer('jumlah');
            $table->bigInteger('total_bayar');
            $table->timestamp('tanggal_transaksi');
            $table->enum('status', [
                'Verifikasi', 'Proses', 'Kirim', 'Sampai', 'Selesai'
            ]);
            $table->timestamps();

            $table->foreign('user_id')
                   ->references('id')->on('users');
            $table->foreign('kode_produk')
                   ->references('kode_produk')->on('produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
