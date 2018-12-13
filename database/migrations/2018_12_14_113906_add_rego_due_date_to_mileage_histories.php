<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegoDueDateToMileageHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mileage_histories', function (Blueprint $table) {
            $table->date('rego_due_date')->nullable();
            $table->integer('next_service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mileage_histories', function (Blueprint $table) {
            //
        });
    }
}
