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
            $table->string('registration');
            $table->string('model')->nullable();
            $table->integer('seats')->nullable();
            $table->string('typeno')->nullable();
            $table->integer('color')->nullable();
            $table->date('cof')->nullable();
            $table->date('reg')->nullable();
            $table->integer('mileage')->default(0);
            $table->integer('ruc')->default(0);
            $table->integer('service')->nullable();
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
