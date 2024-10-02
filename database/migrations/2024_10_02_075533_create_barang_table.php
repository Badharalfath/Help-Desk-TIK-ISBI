<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kd_barang', 6)->primary(); // Primary key berupa kode barang
            $table->string('nama_barang');
            $table->string('merek');
            $table->string('kd_kategori', 6); // Foreign key untuk kategori
            $table->integer('jumlah');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('kd_kategori')->references('kd_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('barang');
    }
}

