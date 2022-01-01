<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugeissuedetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaugeissuedetails', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugeissueno')->nullable();
            $table->string('gaugeissuedate')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
            $table->string('issueapproval')->nullable();
            $table->string('entrydate')->nullable();
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
        Schema::drop('gaugeissuedetails');
    }
}
