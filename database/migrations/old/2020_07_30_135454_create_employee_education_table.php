<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temp_empid')->unsigned();
            $table->text('sslc_details')->nullable();
            $table->text('hsc_details')->nullable();
            $table->text('graduation_details')->nullable();
            $table->text('master_details')->nullable();
            $table->text('doctorate_details')->nullable();
            $table->text('employment_details')->nullable();
            $table->text('employment_reference')->nullable();
            $table->text('skill_details')->nullable();
            $table->text('computer_skill_details')->nullable();
            $table->text('nash_working_details')->nullable();
            $table->text('strength_details')->nullable();
            $table->text('hubby_details')->nullable();
            $table->text('education_description')->nullable();
            $table->text('employee_description')->nullable();
            
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));            
            $table->foreign('temp_empid')->references('id')->on('employee_base_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_education');
    }
}
