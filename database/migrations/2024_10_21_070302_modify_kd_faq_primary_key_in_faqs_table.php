<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKdFaqPrimaryKeyInFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Hapus kolom id sebelum menjadikan kd_faq primary key
        Schema::table('faqs', function (Blueprint $table) {
            // Hapus kolom id
            $table->dropColumn('id');
        });

        // Jadikan kd_faq sebagai primary key
        Schema::table('faqs', function (Blueprint $table) {
            $table->primary('kd_faq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Tambahkan kembali kolom id jika rollback migrasi
        Schema::table('faqs', function (Blueprint $table) {
            $table->id()->first();

            // Hapus primary key dari kd_faq
            $table->dropPrimary('kd_faq');
        });
    }
}
