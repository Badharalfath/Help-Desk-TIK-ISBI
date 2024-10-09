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
    Schema::table('pengadaan', function (Blueprint $table) {
        $table->string('nota')->nullable(); // Menyimpan path gambar, nullable jika tidak wajib
    });
}

public function down()
{
    Schema::table('pengadaan', function (Blueprint $table) {
        $table->dropColumn('nota');
    });
}

};
