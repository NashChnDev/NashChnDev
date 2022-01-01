<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugereturnheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaugereturnheaders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugereturnno')->nullable();
            $table->string('gaugereturndate')->nullable();
            $table->string('gaugereturnreqcode')->nullable();
            $table->string('gaugereturnreqname')->nullable();
            $table->string('gaugereturnreqdept')->nullable();
            $table->integer('gaugeissueno_id')->unsigned()->nullable()->index();
            $table->string('gaugeissuedate')->nullable();
            $table->string('gaugeissuercode')->nullable();
            $table->string('gaugeissuername')->nullable();
            $table->string('gaugeissuerdept')->nullable();
            $table->string('gaugereqreason')->nullable();
            $table->string('gaugereqapprover')->nullable();
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
        Schema::drop('gaugereturnheaders');
    }
}
