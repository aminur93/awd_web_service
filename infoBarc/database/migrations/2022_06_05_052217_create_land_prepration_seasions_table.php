<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandPreprationSeasionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('land_prepration_seasions', function (Blueprint $table) {
            $table->id();
            $table->integer('crop_id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('cultural_operation');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('land_prepration_seasions');
    }
}
