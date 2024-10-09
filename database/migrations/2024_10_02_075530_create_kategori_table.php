<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    public function up()
{
    if (!Schema::hasTable('kategori')) {
        Schema::create('kategori', function (Blueprint $table) {
            $table->string('kd_kategori', 6)->primary();
            $table->string('nama_kategori');
            $table->integer('qty_barang')->default(0);
            $table->timestamps();
        });
    }
}

    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
