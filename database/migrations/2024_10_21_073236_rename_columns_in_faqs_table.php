<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsInFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Ubah nama kolom nama_masalah menjadi pertanyaan
            $table->renameColumn('nama_masalah', 'pertanyaan');

            // Ubah nama kolom penyelesaian_masalah menjadi penyelesaian
            $table->renameColumn('deskripsi_penyelesaian_masalah', 'penyelesaian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            // Kembalikan nama kolom pertanyaan menjadi nama_masalah
            $table->renameColumn('pertanyaan', 'nama_masalah');

            // Kembalikan nama kolom penyelesaian menjadi penyelesaian_masalah
            $table->renameColumn('penyelesaian', 'deskripsi_penyelesaian_masalah');
        });
    }
}
