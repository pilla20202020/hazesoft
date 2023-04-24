<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecieveCarModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recieve_car_models', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('carmodel_id')->unsigned()->index()->nullable();
            $table->foreign('carmodel_id')->references('id')->on('car_models')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('customerlocation_id')->unsigned()->index()->nullable();
            $table->foreign('customerlocation_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('carlocation_id')->unsigned()->index()->nullable();
            $table->foreign('carlocation_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('recieve_car_models');
    }
}
