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
        Schema::create('master_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('spesifikasi');
            $table->integer('jumlah');
            $table->integer('harga_beli');
            $table->date('tanggal_pembelian');
            $table->string('keterangan');
            $table->unsignedBigInteger('ruang_id');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('penanggung_jawab_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('ruang_id')->references('id')->on('ruang');
            $table->foreign('kategori_id')->references('id')->on('kategori');
            $table->foreign('supplier_id')->references('id')->on('supplier');
            $table->foreign('penanggung_jawab_id')->references('id')->on('penanggung_jawab');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_barang');
    }
};
