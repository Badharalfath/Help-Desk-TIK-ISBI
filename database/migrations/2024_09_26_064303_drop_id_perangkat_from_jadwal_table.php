<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropIdPerangkatFromJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            // Hapus kolom id_perangkat langsung tanpa menghapus foreign key jika sudah tidak ada
            $table->dropColumn('id_perangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            // Tambahkan kembali kolom id_perangkat
            $table->unsignedBigInteger('id_perangkat')->nullable();

            // Tambahkan kembali foreign key constraint jika perlu
            $table->foreign('id_perangkat')->references('id')->on('perangkat')->onDelete('cascade');
        });
    }
}
