<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGaugeTypeAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gauge_type_attributes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->integer('gaugetypes_id')->unsigned()->nullable()->index();
            $table->string('attributename')->nullable();
            $table->string('datatype')->nullable();
            $table->foreign('gaugetypes_id')->references('id')->on('gauge_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gauge_type_attributes');
    }
}
