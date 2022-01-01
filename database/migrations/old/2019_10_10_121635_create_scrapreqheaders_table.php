<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScrapreqheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrapreqheaders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('scrapreqno')->nullable();
            $table->string('scrapreqdate')->nullable();
            $table->string('scrapreqempcode')->nullable();
            $table->string('scrapreqempname')->nullable();
            $table->string('scrapreqempdept')->nullable();
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
        Schema::drop('scrapreqheaders');
    }
}
