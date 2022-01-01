<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugerequestheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gaugerequestheaders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugereqno')->nullable();
            $table->string('gaugereqdate')->nullable();
            $table->string('gaugereqcode')->nullable();
            $table->string('gaugereqname')->nullable();
            $table->string('gaugereqdept')->nullable();
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
        Schema::drop('gaugerequestheaders');
    }
}
