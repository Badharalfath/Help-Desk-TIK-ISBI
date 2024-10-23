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
    
        // Menambahkan kolom kd_status di tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('kd_status', 5)->nullable();

            // Menambahkan foreign key constraint
            $table->foreign('kd_status')->references('kd_status')->on('kategori_status')
                  ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop foreign key dan kolom jika di-rollback di tabel jadwal
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['kd_status']);
            $table->dropColumn('kd_status');
        });

        // Drop foreign key dan kolom jika di-rollback di tabel tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropForeign(['kd_status']);
            $table->dropColumn('kd_status');
        });
    }
};
