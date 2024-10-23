<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan DB facade untuk insert data

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kategori_progres', function (Blueprint $table) {
            $table->string('kd_progres', 5)->primary(); // Primary key dengan limit 5 dan format PG001, PG002
            $table->string('nama_progres', 50);
            $table->timestamps(); // Tambahkan timestamps jika diperlukan
        });

        // Insert default values
        DB::table('kategori_progres')->insert([
            ['kd_progres' => 'PG001', 'nama_progres' => 'pending'],
            ['kd_progres' => 'PG002', 'nama_progres' => 'on going'],
            ['kd_progres' => 'PG003', 'nama_progres' => 'complete'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('kategori_progres');
    }
};
