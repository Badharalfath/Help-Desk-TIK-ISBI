<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBidangPermasalahanInFaqsTable extends Migration
{
    public function up()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('bidang_permasalahan', 255)->change();
        });
    }

    public function down()
    {
        Schema::table('faqs', function (Blueprint $table) {
            $table->string('bidang_permasalahan')->change(); // Adjust this if you want to revert to a different length
        });
    }
}
