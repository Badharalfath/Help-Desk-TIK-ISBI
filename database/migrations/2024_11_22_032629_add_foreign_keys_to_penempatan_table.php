<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penempatan', function (Blueprint $table) {
            // Menambahkan kolom kd_lokasi dan kd_departemen
            $table->string('kd_lokasi')->after('kd_penempatan')->nullable();
            $table->string('kd_departemen')->after('kd_lokasi')->nullable();

            // Menambahkan foreign key
            $table->foreign('kd_lokasi')->references('kd_lokasi')->on('lokasi')->onDelete('cascade');
            $table->foreign('kd_departemen')->references('kd_departemen')->on('departemen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penempatan', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['kd_lokasi']);
            $table->dropForeign(['kd_departemen']);

            // Drop kolom
            $table->dropColumn(['kd_lokasi', 'kd_departemen']);
        });
    }
};
