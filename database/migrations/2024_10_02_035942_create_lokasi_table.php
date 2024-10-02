<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiTable extends Migration
{
    public function up()
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->string('kode')->primary(); // Kode diawali dengan L (contoh: L001)
            $table->string('nama_lokasi');
            $table->string('kode_departemen');
            $table->foreign('kode_departemen')->references('kode')->on('departemen')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lokasi');
    }
}
