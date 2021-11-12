<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAreaToPrefectureOnSouvenirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('souvenirs', function (Blueprint $table) {
            $table->renameColumn('area', 'prefecture');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('souvenirs', function (Blueprint $table) {
            $table->renameColumn('prefecture', 'area');
        });
    }
}
