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
        // Mengubah nama tabel status menjadi kategori_status
        Schema::rename('status', 'kategori_status');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Mengubah kembali nama tabel kategori_status menjadi status
        Schema::rename('kategori_status', 'status');
    }
};
