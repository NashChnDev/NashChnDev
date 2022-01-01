<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropDownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_downs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('fieldsname')->nullable();
            $table->string('optionvalue')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('drop_downs');
    }
}
