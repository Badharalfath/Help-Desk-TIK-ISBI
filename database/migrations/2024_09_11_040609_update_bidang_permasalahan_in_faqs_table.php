<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Tambahkan ini

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ubah kolom 'bidang_permasalahan' dari string ke enum
        Schema::table('faqs', function (Blueprint $table) {
            $table->enum('bidang_permasalahan', ['it', 'apps'])->change();
        });

        // Menyesuaikan data yang sudah ada
        DB::table('faqs')->whereNotIn('bidang_permasalahan', ['it', 'apps'])
            ->update(['bidang_permasalahan' => 'it']); // Atur default value untuk data yang tidak sesuai
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Kembalikan perubahan, mengubah enum kembali menjadi string
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('bidang_permasalahan')->change();
        });
    }
};
