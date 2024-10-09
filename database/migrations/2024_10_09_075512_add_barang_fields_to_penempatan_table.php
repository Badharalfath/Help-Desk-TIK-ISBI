<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarangFieldsToPenempatanTable extends Migration
{
    public function up()
    {
        Schema::table('penempatan', function (Blueprint $table) {
            // Add foreign key fields for barang
            $table->string('kd_barang', 6)->nullable();
            $table->string('nama_barang', 255)->nullable();

            // Set up foreign key constraints
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('penempatan', function (Blueprint $table) {
            // Drop foreign keys and columns if rolling back
            $table->dropForeign(['kd_barang']);
            $table->dropColumn(['kd_barang', 'nama_barang']);
        });
    }
}
