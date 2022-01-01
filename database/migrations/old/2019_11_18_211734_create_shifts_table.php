<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('shiftcode')->nullable();
            $table->string('shiftname')->nullable();
            $table->string('shiftincharge')->nullable();
            $table->string('shiftstarttime')->nullable();
            $table->string('shiftendtime')->nullable();
            $table->string('createdby')->nullable();
            $table->integer('company_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shifts');
    }
}
