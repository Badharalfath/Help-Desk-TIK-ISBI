<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyAndColumnsFromJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            // Jika tabel perangkat atau kolom id_perangkat sudah tidak ada, jangan hapus foreign key
            // $table->dropForeign(['id_perangkat']); // baris ini bisa dihapus jika foreign key sudah tidak ada
            
            // Hapus kolom yang terkait (jika kolom belum dihapus)
            // $table->dropColumn('id_perangkat'); // ini juga bisa dihapus jika kolom sudah dihapus
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
            // Tambahkan kembali kolom dan foreign key jika diperlukan
            // Namun, jika tabel atau kolom sudah tidak ada, Anda bisa menghapus atau mengomentari baris-baris berikut.
            $table->unsignedBigInteger('id_perangkat')->nullable();
            $table->foreign('id_perangkat')->references('id')->on('perangkat')->onDelete('cascade');
        });
    }
}
