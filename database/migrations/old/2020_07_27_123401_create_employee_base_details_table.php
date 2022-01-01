<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeBaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_base_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email_id',255)->nullable();
            $table->string('joininglocation','255')->nullable();
            $table->string('department','255')->nullable();
            $table->string('designation','255')->nullable();
            $table->date('date_of_interview','255')->nullable();
            $table->date('date_of_joining','255')->nullable();
            $table->string('employee_id','255')->nullable();
            $table->string('employee_desc','255')->nullable();
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_base_details');
    }
}
