<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKdBarangInTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Pastikan kd_barang bertipe string atau sesuai dengan tipe data di tabel barang
            $table->string('kd_barang')->change();

            // Tambahkan foreign key untuk kd_barang yang terhubung ke tabel barang
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
        Schema::table('transaksi', function (Blueprint $table) {
            // Hapus foreign key saat rollback
            $table->dropForeign(['kd_barang']);

            // Jika perlu, kamu bisa mengubah kembali tipe kolom kd_barang ke kondisi sebelumnya
            // $table->integer('kd_barang')->change();
        });
    }
}
