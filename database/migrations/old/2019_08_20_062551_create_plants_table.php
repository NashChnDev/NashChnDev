<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('plantcode')->nullable();
            $table->string('organization')->nullable();
            $table->string('location')->nullable();
            $table->string('plantname')->nullable();
            $table->string('plantaddress')->nullable();
            $table->string('plantincharge')->nullable();
            $table->string('plantinchargephone')->nullable();
            $table->string('plantinchargeemail')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plants');
    }
}
