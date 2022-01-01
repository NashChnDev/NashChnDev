<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauges', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('gaugecode')->nullable();
            $table->string('gaugedescription')->nullable();
            $table->string('gaugecategory')->nullable();
            
            $table->integer('gaugetypes_id')->unsigned()->nullable()->index();
            $table->foreign('gaugetypes_id')->references('id')->on('gauge_types')->onDelete('cascade');
            
            $table->integer('cost')->nullable();
            $table->string('mfrdate')->nullable();
            $table->integer('leadtime')->nullable();
            $table->integer('alertdays')->nullable();
            
            $table->integer('least_count_masters_id')->unsigned()->nullable()->index();
            $table->foreign('least_count_masters_id')->references('id')->on('least_count_masters')->onDelete('cascade');
            
            $table->integer('ranges_id')->unsigned()->nullable()->index();
            $table->foreign('ranges_id')->references('id')->on('ranges')->onDelete('cascade');
            
            $table->integer('manufacturervendor_id')->unsigned()->nullable()->index();
            $table->foreign('manufacturervendor_id')->references('id')->on('vendors')->onDelete('cascade');
            
            $table->integer('plant_id')->unsigned()->nullable()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');
            
            $table->string('operation')->nullable();
            
            $table->integer('production_line_id')->unsigned()->nullable()->index();
            $table->foreign('production_line_id')->references('id')->on('production_lines')->onDelete('cascade');
            
            $table->string('gaugedrawingno')->nullable();
            $table->string('gaugestatus')->nullable();
            $table->string('usagetype')->nullable();
            $table->string('gaugelastreceived')->nullable();
            $table->integer('quantityreceived')->nullable();
            $table->string('InitialGaugeAcceptanceDt')->nullable();
            $table->integer('CalibrationFrequencyindays')->nullable();
            $table->string('CalibrationDueDate')->nullable();
            $table->string('PartNumbers')->nullable();
            $table->integer('MinQuantity')->nullable();
            
            $table->integer('Attachments_id')->nullable();
            
            $table->integer('DrawingManual')->unsigned()->nullable()->index();
            $table->foreign('DrawingManual')->references('id')->on('attachments')->onDelete('cascade');
            
            $table->string('AttributeValues')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gauges');
    }
}
