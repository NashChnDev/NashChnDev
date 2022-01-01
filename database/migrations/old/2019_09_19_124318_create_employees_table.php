<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('empcode')->nullable();
            $table->string('empname')->nullable();
            $table->integer('department_id')->unsigned()->nullable()->index();
            $table->string('empemail')->nullable();
            $table->string('empmobile')->nullable();
            $table->string('empaddress')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('empplace')->nullable();
            $table->string('empphoto')->nullable();
            $table->string('empstatus')->nullable();
            $table->string('empremarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
