<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->date('last_service_date')->nullable();
            $table->integer('hubemeter_reading')->nullable();
            $table->string('company')->nullable();
            $table->integer('last_editor')->nullable();
            $table->integer('ruc')->nullable()->change();
            $table->integer('service')->nullable()->change();
            $table->integer('odometer_reading')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['last_service_date','hubemeter_reading','company','last_editor']);
        });
    }
}
