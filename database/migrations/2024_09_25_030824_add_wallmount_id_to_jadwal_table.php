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
            $table->unsignedBigInteger('wallmount_id')->nullable();

            // Jika ada foreign key
            $table->foreign('wallmount_id')->references('id')->on('wallmount')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropForeign(['wallmount_id']);
            $table->dropColumn('wallmount_id');
        });
    }

};
