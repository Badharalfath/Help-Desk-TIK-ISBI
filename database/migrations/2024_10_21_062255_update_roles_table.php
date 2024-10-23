<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Hapus indeks unik dari kd_role
            $table->dropUnique('roles_kd_role_unique');

            // Jadikan kd_role sebagai primary key
            $table->primary('kd_role');

            // Ubah kolom role menjadi enum
            $table->enum('role', ['admin', 'operator', 'kepala'])->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Hapus primary key dari kd_role
            $table->dropPrimary('kd_role');

            // Tambahkan kembali indeks unik ke kd_role
            $table->unique('kd_role');

            // Kembalikan kolom role ke tipe string
            $table->string('role')->change();
        });
    }
}
