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
        // Hapus kolom 'id' jika ada
        if (Schema::hasColumn('faqs', 'id')) {
            Schema::table('faqs', function (Blueprint $table) {
                $table->dropColumn('id');
            });
        }

        // Pastikan kolom 'kd_faq' ada dan hapus constraint unique jika ada
        Schema::table('faqs', function (Blueprint $table) {
            if (Schema::hasColumn('faqs', 'kd_faq')) {
                // Drop unique constraint jika ada
                $table->dropUnique(['kd_faq']);
                // Ubah posisi 'kd_faq' agar muncul sebelum 'pertanyaan'
                $table->string('kd_faq')->change()->before('pertanyaan');
            } else {
                // Tambahkan kolom 'kd_faq' sebelum 'pertanyaan'
                $table->string('kd_faq')->before('pertanyaan');
            }
        });

        // Jadikan 'kd_faq' sebagai primary key
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
        // Hapus primary key 'kd_faq' saat rollback
        Schema::table('faqs', function (Blueprint $table) {
            $table->dropPrimary(['kd_faq']);
        });

        // Tambahkan kembali kolom 'id' jika rollback migrasi
        Schema::table('faqs', function (Blueprint $table) {
            $table->id()->first();
        });

        // Kembalikan unique constraint ke 'kd_faq' jika dibutuhkan
        Schema::table('faqs', function (Blueprint $table) {
            $table->unique('kd_faq');
        });
    }
}
