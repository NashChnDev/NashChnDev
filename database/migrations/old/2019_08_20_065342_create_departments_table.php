<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function(Blueprint $table)
        {
            /*$table->increments('id');
            $table->timestamps();
            $table->string('deptname')->nullable();
            $table->string('deptdescription')->nullable();
            $table->integer('plant_id')->unsigned()->nullable()->index();
            $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');*/
            
            $table->increments('id');
            $table->timestamps();
            $table->string('deptname')->nullable();
            $table->string('deptdescription')->nullable();
            $table->string('company_name')->nullable();
            $table->string('plant_id')->nullable()->index();
           // $table->foreign('plant_id')->references('id')->on('plants')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('departments');
    }
}
