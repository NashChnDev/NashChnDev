<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistorycardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historycards', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('devices_id')->unsigned()->nullable()->index();
            $table->string('devices_description')->nullable();
            $table->string('device_scategory')->nullable();
            $table->string('device_sasseterpcode')->nullable();
            $table->string('devices_sizerange')->nullable();
            $table->string('device_smake')->nullable();
            $table->string('devices_units')->nullable();
            $table->string('devices_property')->nullable();
            $table->string('devices_storgelocation')->nullable();
            $table->string('devices_range')->nullable();
            $table->string('devices_leastcount')->nullable();
            $table->string('devices_accuracy')->nullable();
            $table->string('devices_acceptancecriteria')->nullable();
            $table->string('devices_frequencyofCalibration')->nullable();
            $table->string('devices_frequencyofCalibration_duration')->nullable();
            $table->string('devices_alerydays')->nullable();
            $table->integer('vendors_id')->unsigned()->nullable()->index();
            $table->string('devices_dateofpurchase')->nullable();
            $table->string('lastcalibrationdate')->nullable();
            $table->string('devices_costininr')->nullable();
            $table->integer('customer_id')->unsigned()->nullable()->index();
            $table->string('devices_project')->nullable();
            $table->string('devices_part')->nullable();
            $table->string('devices_operation')->nullable();
            $table->string('devices_certificatereceived')->nullable();
            $table->string('devices_certificateno')->nullable();
            $table->string('devices_certificateupload')->nullable();
            $table->string('devices_method')->nullable();
            $table->string('devices_CalibratedBy')->nullable();
            $table->string('devices_CalibratedOn')->nullable();
            $table->string('devices_CheckedBy')->nullable();
            $table->string('devices_ApprovedBY')->nullable();
            $table->string('devices_ApprovedOn')->nullable();
            $table->string('devices_CalibrationResult')->nullable();
            $table->string('devices_Treacibility')->nullable();
            $table->string('status')->nullable();
            $table->string('device_VariableType')->nullable();
            $table->string('device_MechanismType')->nullable();
            $table->string('Capacity')->nullable();
            $table->string('clibration_source')->nullable();
            $table->string('WarrantyPeriod')->nullable();
            $table->string('AMCRequired')->nullable();
            $table->string('WHOSource')->nullable();
            $table->string('CostofAMC')->nullable();
            $table->string('PurchaseBill')->nullable();
            $table->string('WARRANTYCARD')->nullable();
            $table->string('device_NorINcalibrationreqno')->nullable();
            $table->string('calibrationreqdate')->nullable();
            $table->string('calibrationreqby')->nullable();
            $table->string('calibrationissueno')->nullable();
            $table->string('calibrationissuedate')->nullable();
            $table->string('calibrationissueby')->nullable();
            $table->string('calibratedon')->nullable();
            $table->string('calibratedby')->nullable();
            $table->string('calibratedresult')->nullable();
            $table->string('calibratedcertificate')->nullable();
            $table->string('complete_status')->nullable();
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
        Schema::drop('historycards');
    }
}
