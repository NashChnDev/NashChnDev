<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalibrationsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('calibrationreqno_id')->unsigned()->nullable()->index();
            $table->string('calibrationreqdate')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
            $table->string('quantity')->nullable();
            $table->string('clibration_source')->nullable();
            $table->string('vendorcode')->nullable();
            $table->string('vendordescription')->nullable();
            $table->string('entrydate')->nullable();
            $table->string('createdby')->nullable();
            $table->integer('company_id')->unsigned()->nullable()->index();
            $table->integer('plant_id')->unsigned()->nullable()->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calibrations_details');
    }
}
