<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('kd_transaksi', 7)->primary();
            $table->date('tgl_transaksi');
            $table->string('keterangan', 255)->nullable();
            $table->string('kd_barang', 6);
            $table->string('nota', 255)->nullable();
            $table->timestamps();

            // Menambahkan foreign key untuk kd_barang
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}

