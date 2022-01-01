<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScrapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scraps', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('scrapreqno')->nullable();
            $table->string('scrapreqdate')->nullable();
            $table->string('scrapreqby')->nullable();
            $table->string('scrapreqstatus')->nullable();
            $table->string('scrapreqremarks')->nullable();
            $table->string('scrapissueno')->nullable();
            $table->string('scrapissuedate')->nullable();
            $table->string('scrapissueby')->nullable();
            $table->string('scrapissuestatus')->nullable();
            $table->string('scrapissueremarks')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
            $table->string('clibration_source')->nullable();
            $table->string('vendorcode')->nullable();
            $table->string('vendordescription')->nullable();
            $table->string('device_smake')->nullable();
            $table->string('devices_dateofpurchase')->nullable();
            $table->string('devices_costininr')->nullable();
            $table->string('WarrantyPeriod')->nullable();
            $table->string('status')->nullable();
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
        Schema::drop('scraps');
    }
}
