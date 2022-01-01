<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_lines', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('linedescription')->nullable();
            $table->integer('plant_id')->unsigned()->nullable()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('production_lines');
    }
}
