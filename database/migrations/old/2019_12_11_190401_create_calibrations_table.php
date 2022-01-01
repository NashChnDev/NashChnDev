<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalibrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibrations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('calibrationreqno')->nullable();
            $table->string('calibrationreqdate')->nullable();
            $table->string('calibrationreqby')->nullable();
            $table->string('calibrationreqstatus')->nullable();
            $table->string('calibrationreqremarks')->nullable();
            $table->string('calibrationissueno')->nullable();
            $table->string('calibrationissuedate')->nullable();
            $table->string('calibrationissueby')->nullable();
            $table->string('calibrationissuestatus')->nullable();
            $table->string('calibrationissueremarks')->nullable();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devicescategory')->nullable();
            $table->string('devicesdescription')->nullable();
            $table->string('deviceserpcode')->nullable();
            $table->string('devicessizerange')->nullable();
            $table->string('quantity')->nullable();
            $table->string('clibration_source')->nullable();
            $table->string('vendorcode')->nullable();
            $table->string('vendordescription')->nullable();
            $table->string('providedfor')->nullable();
            $table->string('dcno')->nullable();
            $table->string('dcdate')->nullable();
            $table->string('dcentryby')->nullable();
            $table->string('dcremarks')->nullable();
            $table->string('grnno')->nullable();
            $table->string('grndate')->nullable();
            $table->string('invoiceno')->nullable();
            $table->string('invoicedate')->nullable();
            $table->string('refno')->nullable();
            $table->string('receiptno')->nullable();
            $table->string('receiptdate')->nullable();
            $table->string('receiptentryby')->nullable();
            $table->string('calibratedon')->nullable();
            $table->string('calibratedby')->nullable();
            $table->string('calibratedresult')->nullable();
            $table->string('calibratedcertificate')->nullable();
            $table->string('pono')->nullable();
            $table->string('podate')->nullable();
            $table->string('servicesheet')->nullable();
            $table->string('billingno')->nullable();
            $table->string('billingdate')->nullable();
            $table->string('billingremarks')->nullable();
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
        Schema::drop('calibrations');
    }
}
