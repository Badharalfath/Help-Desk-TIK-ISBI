<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJumlahToPenempatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penempatan', function (Blueprint $table) {
            $table->integer('jumlah')->after('nama_barang'); // Menambahkan kolom 'jumlah' setelah 'nama_barang'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penempatan', function (Blueprint $table) {
            $table->dropColumn('jumlah');
        });
    }
}
