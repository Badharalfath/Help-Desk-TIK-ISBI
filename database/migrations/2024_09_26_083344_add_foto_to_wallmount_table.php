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
        Schema::table('wallmount', function (Blueprint $table) {
            $table->string('foto')->nullable(); // Menambahkan kolom foto
        });
    }

    public function down()
    {
        Schema::table('wallmount', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }

};
