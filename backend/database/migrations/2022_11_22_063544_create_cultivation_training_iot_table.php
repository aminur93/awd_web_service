<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCultivationTrainingIotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cultivation_training_iot', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('crop_name')->nullable();
            $table->string('land_size')->nullable();
            $table->string('category_name')->nullable();
            $table->text('details')->nullable();
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
        Schema::dropIfExists('cultivation_training_iot');
    }
}
