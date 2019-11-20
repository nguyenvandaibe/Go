5<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('order');
            $table->string('place');
            $table->float('place_lat');
            $table->float('place_lng');
            $table->dateTime('arrive_time');
            $table->dateTime('depature_time');
            $table->enum('vehicle', ['bike', 'motorbike', 'car']);
            $table->string('activity');
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
        Schema::dropIfExists('points');
    }
}
