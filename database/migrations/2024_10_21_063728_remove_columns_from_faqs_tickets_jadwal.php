<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsFromFaqsTicketsJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hapus kolom bidang_permasalahan di tabel faqs
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn('bidang_permasalahan');
        });

        // Hapus kolom kategori di tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });

        // Hapus kolom kategori di tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Tambahkan kembali kolom bidang_permasalahan di tabel faqs
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('bidang_permasalahan')->nullable();
        });

        // Tambahkan kembali kolom kategori di tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('kategori')->nullable();
        });

        // Tambahkan kembali kolom kategori di tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->string('kategori')->nullable();
        });
    }
}
