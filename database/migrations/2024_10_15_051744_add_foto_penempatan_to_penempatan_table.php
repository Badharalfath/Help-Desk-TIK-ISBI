<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoPenempatanToPenempatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penempatan', function (Blueprint $table) {
            $table->string('foto_penempatan')->nullable()->after('keterangan');  // Menambahkan kolom foto_penempatan setelah keterangan
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
            $table->dropColumn('foto_penempatan');  // Menghapus kolom foto_penempatan jika migrasi dibatalkan
        });
    }
}
