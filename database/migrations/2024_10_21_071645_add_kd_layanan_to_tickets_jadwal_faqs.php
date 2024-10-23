<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKdLayananToTicketsJadwalFaqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tambahkan kolom kd_layanan di tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('kd_layanan', 5)->nullable();

            // Tambahkan foreign key constraint
            $table->foreign('kd_layanan')->references('kd_layanan')->on('kategori_layanan')->onDelete('set null');
        });

        // Tambahkan kolom kd_layanan di tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->string('kd_layanan', 5)->nullable();

            // Tambahkan foreign key constraint
            $table->foreign('kd_layanan')->references('kd_layanan')->on('kategori_layanan')->onDelete('set null');
        });

        // Tambahkan kolom kd_layanan di tabel faqs
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('kd_layanan', 5)->nullable();

            // Tambahkan foreign key constraint
            $table->foreign('kd_layanan')->references('kd_layanan')->on('kategori_layanan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Hapus foreign key dan kolom kd_layanan dari tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['kd_layanan']);
            $table->dropColumn('kd_layanan');
        });

        // Hapus foreign key dan kolom kd_layanan dari tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['kd_layanan']);
            $table->dropColumn('kd_layanan');
        });

        // Hapus foreign key dan kolom kd_layanan dari tabel faqs
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropForeign(['kd_layanan']);
            $table->dropColumn('kd_layanan');
        });
    }
}
