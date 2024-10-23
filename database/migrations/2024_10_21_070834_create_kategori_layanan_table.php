<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriLayananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_layanan', function (Blueprint $table) {
            // Primary key dengan struktur LY001, LY002, dst.
            $table->string('kd_layanan', 5)->primary();

            // Kolom nama layanan
            $table->string('nama_layanan');

            // Timestamps untuk created_at dan updated_at
            $table->timestamps();
        });

        // Insert default values ke tabel 'kategori_layanan'
        DB::table('kategori_layanan')->insert([
            ['kd_layanan' => 'LY001', 'nama_layanan' => 'Jaringan/Internet'],
            ['kd_layanan' => 'LY002', 'nama_layanan' => 'Aplikasi'],
            ['kd_layanan' => 'LY003', 'nama_layanan' => 'Email'],
            ['kd_layanan' => 'LY004', 'nama_layanan' => 'Wallmount'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_layanan');
    }
}
