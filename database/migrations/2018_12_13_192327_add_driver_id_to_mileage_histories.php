<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDriverIdToMileageHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mileage_histories', function($table) {
            $table->integer('driver_id')->nullable();
            $table->date('date')->nullable();
            $table->string('group_code')->nullable();
            $table->date('cof_due_date')->nullable();
            $table->integer('cof')->nullable();
            $table->integer('total_fuel')->nullable();
            $table->integer('hubmeter_reading')->nullable();
            $table->enum('body', array('fine', 'problem'))->default('fine');
            $table->enum('mechanics', array('fine', 'problem'))->default('fine');
            $table->enum('hygiene', array('fine', 'problem'))->default('fine');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mileage_histories', function($table) {
            $table->dropColumn('driver_id');
            $table->dropColumn('date');
            $table->dropColumn('group_code');
            $table->dropColumn('cof_due_date');
            $table->dropColumn('cof');
            $table->dropColumn('total_fuel');
            $table->dropColumn('hubmeter_reading');
            $table->dropColumn('body');
            $table->dropColumn('mechanics');
            $table->dropColumn('hygiene');
        });
    }
}
