<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('key')->nullable();
            $table->string('reqprefix')->nullable();
            $table->string('reqsuffix')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('keyvalue')->nullable();
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
        Schema::drop('configurations');
    }
}
