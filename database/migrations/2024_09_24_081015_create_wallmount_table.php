<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_wallmount_table.php
    public function up()
    {
        Schema::create('wallmount', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nama');
            $table->string('lokasi');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallmount');
    }
};