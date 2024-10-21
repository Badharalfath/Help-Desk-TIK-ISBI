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
    Schema::create('status', function (Blueprint $table) {
        $table->string('kd_status', 1)->primary();
        $table->string('nama_status', 50);
    });

    // Insert default values
    DB::table('status')->insert([
        ['kd_status' => '1', 'nama_status' => 'pending'],
        ['kd_status' => '2', 'nama_status' => 'ongoing'],
        ['kd_status' => '3', 'nama_status' => 'complete']
    ]);
}

public function down()
{
    Schema::dropIfExists('status');
}

};
