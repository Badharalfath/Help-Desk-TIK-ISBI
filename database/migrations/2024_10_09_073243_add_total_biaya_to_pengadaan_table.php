<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePengadaanTableAddTotalBiaya extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pengadaan', function (Blueprint $table) {
            if (!Schema::hasColumn('pengadaan', 'total_biaya')) {
                $table->decimal('total_biaya', 15, 2)->nullable()->default(0)->after('harga_unit');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pengadaan', function (Blueprint $table) {
            if (Schema::hasColumn('pengadaan', 'total_biaya')) {
                $table->dropColumn('total_biaya');
            }
        });
    }
}

