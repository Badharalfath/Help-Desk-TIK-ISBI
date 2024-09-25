<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->unsignedBigInteger('perangkat_id')->nullable()->after('wallmount_id');

            // Jika perangkat memiliki foreign key
            $table->foreign('perangkat_id')->references('id')->on('perangkat')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['perangkat_id']);
            $table->dropColumn('perangkat_id');
        });
    }

};
