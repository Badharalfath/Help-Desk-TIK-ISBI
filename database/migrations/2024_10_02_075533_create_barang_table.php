<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('barang')) {
            Schema::create('barang', function (Blueprint $table) {
                $table->string('kd_barang', 6)->primary();
                $table->string('nama_barang');
                $table->string('merek');
                $table->string('kd_kategori', 6);
                $table->integer('jumlah');
                $table->string('foto')->nullable();
                $table->timestamps();
            });
        }
    }


    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
