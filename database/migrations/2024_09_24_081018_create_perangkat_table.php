<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_perangkat_table.php
    public function up()
    {
        Schema::create('perangkat', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nama_perangkat');
            $table->unsignedBigInteger('id_wallmount');
            $table->foreign('id_wallmount')->references('id')->on('wallmount')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perangkat');
    }
};
