<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id(); // Auto increment nomor barang
            $table->string('kd_barang')->unique(); // Kode barang dengan format B001, B002, dst.
            $table->string('nama_barang');
            $table->string('merek');
            $table->unsignedBigInteger('kd_kategori'); // Foreign key ke tabel kategori
            $table->integer('jumlah');
            $table->string('foto'); // Menyimpan path foto
            $table->timestamps();

            // Definisi foreign key
            $table->foreign('kd_kategori')->references('kd_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
