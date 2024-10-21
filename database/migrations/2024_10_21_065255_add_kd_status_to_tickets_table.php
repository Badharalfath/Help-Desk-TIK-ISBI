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
    Schema::table('tickets', function (Blueprint $table) {
        $table->string('kd_status', 1)->nullable();

        // Optional: tambahkan foreign key jika ingin menghubungkan tabel 'tickets' dengan 'status'
        $table->foreign('kd_status')->references('kd_status')->on('status');
    });
}

public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropForeign(['kd_status']);
        $table->dropColumn('kd_status');
    });
}

};
