<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->string('kd_status', 5)->primary(); // Ubah limit menjadi 5
            $table->string('nama_status', 50);
        });

        // Insert default values
        DB::table('status')->insert([
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
        Schema::dropIfExists('status');
    }
};
