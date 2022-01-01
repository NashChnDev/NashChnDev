<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScrapreqdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapreqdetails', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('scrapreqno')->nullable();
            $table->string('scrapreqdate')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::drop('scrapreqdetails');
    }
}
