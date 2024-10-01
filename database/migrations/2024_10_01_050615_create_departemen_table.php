<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartemenTable extends Migration
{
    public function up()
    {
        Schema::create('departemen', function (Blueprint $table) {
            $table->string('kode', 10)->primary(); // Kode with D format
            $table->string('nama_departemen');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departemen');
    }
}
