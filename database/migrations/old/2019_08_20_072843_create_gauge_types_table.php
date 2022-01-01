<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauge_types', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugetypes')->nullable();
            $table->string('description', 1000)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gauge_types');
    }
}
