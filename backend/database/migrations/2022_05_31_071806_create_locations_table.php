<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('division_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('thana_id')->unsigned();
            $table->integer('village_id')->unsigned();
            $table->integer('post_office_id')->unsigned();
            $table->integer('poc_id')->unsigned();
            $table->integer('union_id')->unsigned();
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
        Schema::dropIfExists('locations');
    }
}
