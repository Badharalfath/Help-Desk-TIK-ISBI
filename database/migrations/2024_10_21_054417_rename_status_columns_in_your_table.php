<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStatusColumnsInYourTable extends Migration
{
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Rename the columns
            $table->renameColumn('permission_status', 'status');
            $table->renameColumn('progress_status', 'progress');
        });
    }

    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Reverse the column renames
            $table->renameColumn('status', 'permission_status');
            $table->renameColumn('progress', 'progress_status');
        });
    }
}
