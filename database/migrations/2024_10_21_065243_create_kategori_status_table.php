<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Buat tabel 'kategori_status'
        Schema::create('kategori_status', function (Blueprint $table) {
            $table->string('kd_status', 5)->primary();
            $table->string('nama_status', 50);
        });

        // Insert default values ke tabel 'kategori_status'
        DB::table('kategori_status')->insert([
            ['kd_status' => 'ST001', 'nama_status' => 'pending'],
            ['kd_status' => 'ST002', 'nama_status' => 'rejected'],
            ['kd_status' => 'ST003', 'nama_status' => 'approved']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Hapus tabel 'kategori_status' jika rollback
        Schema::dropIfExists('kategori_status');
    }
};
