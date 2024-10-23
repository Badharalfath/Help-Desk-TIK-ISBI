<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Menambahkan kolom kd_progres ke tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('kd_progres', 5)->nullable(); // Atur nullable sesuai kebutuhan
            $table->foreign('kd_progres')->references('kd_progres')->on('kategori_progres')
                ->onUpdate('cascade')->onDelete('set null');
        });

        // Menambahkan kolom kd_progres ke tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->string('kd_progres', 5)->nullable(); // Atur nullable sesuai kebutuhan
            $table->foreign('kd_progres')->references('kd_progres')->on('kategori_progres')
                ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Hapus foreign key dan kolom kd_progres dari tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['kd_progres']);
            $table->dropColumn('kd_progres');
        });

        // Hapus foreign key dan kolom kd_progres dari tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['kd_progres']);
            $table->dropColumn('kd_progres');
        });
    }
};
