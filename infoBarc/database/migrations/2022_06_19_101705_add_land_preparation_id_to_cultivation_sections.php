<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLandPreparationIdToCultivationSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cultivation_sections', function (Blueprint $table) {
            $table->integer('land_preparation_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cultivation_sections', function (Blueprint $table) {
            $table->dropColumn('land_preparation_id');
        });
    }
}
