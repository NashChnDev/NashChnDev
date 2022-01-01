<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('vendortypes')->nullable();
            $table->string('vendorname')->nullable();
            $table->string('contactperson')->nullable();
            $table->string('phoneno')->nullable();
            $table->string('landlineno')->nullable();
            $table->string('emailid')->nullable();
            $table->string('address')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vendors');
    }
}
