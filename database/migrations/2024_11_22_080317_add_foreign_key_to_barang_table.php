<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToBarangTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Tambahkan foreign key pada kolom kd_kategori
            $table->foreign('kd_kategori')
                  ->references('kd_kategori')
                  ->on('kategori_aset')
                  ->onDelete('cascade'); // Jika kategori dihapus, barang terkait juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            // Hapus foreign key jika migrasi di-rollback
            $table->dropForeign(['kd_kategori']);
        });
    }
}
