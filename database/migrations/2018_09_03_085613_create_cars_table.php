<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('plate');
            $table->unsignedInteger('no_of_seats')->nullable();
            $table->string('tyreinfo')->nullable();
            $table->unsignedInteger('year_of_manufacture')->nullable();
            $table->date('cof')->nullable();
            $table->date('reg')->nullable();
            $table->integer('service')->nullable();
            $table->integer('ruc')->default(0);
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('vin')->nullable();
            $table->string('main_colour')->nullable();
            $table->string('engine_no')->nullable();
            $table->integer('odometer_reading')->default(0);
            $table->string('sharing_mark')->nullable();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
