<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugeissueheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaugeissueheaders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugeissueno')->nullable();
            $table->string('gaugeissuedate')->nullable();
            $table->integer('gaugereqno_id')->unsigned()->nullable()->index();
            $table->string('gaugereqname')->nullable();
            $table->string('gaugereqdept')->nullable();
            $table->string('gaugereqreason')->nullable();
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
        Schema::drop('gaugeissueheaders');
    }
}
