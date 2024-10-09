<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenempatanTable extends Migration
{
    public function up()
    {
        Schema::create('penempatan', function (Blueprint $table) {
            $table->string('kd_penempatan')->primary(); // Set kd_penempatan as primary key
            $table->date('tgl_penempatan'); // Tanggal penempatan
            $table->string('keterangan'); // Keterangan penempatan
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('penempatan');
    }
}
