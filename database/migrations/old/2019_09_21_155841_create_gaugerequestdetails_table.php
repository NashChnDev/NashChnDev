<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugerequestdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaugerequestdetails', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('gaugereqno_id')->unsigned()->nullable()->index();
            $table->string('gaugereqdate')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
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
        Schema::drop('gaugerequestdetails');
    }
}
