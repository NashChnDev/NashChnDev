<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeFileDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_file_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temp_empid')->unsigned();
            $table->string('file_base_path','255')->nullable();            
            $table->string('file_name','255')->nullable();
            $table->string('file_description','255')->nullable();
            $table->text('file_path')->nullable();
            $table->string('removebtn',155)->nullable();
            $table->integer('verified_status')->default('0');   
            $table->integer('view_status')->default('0');                        
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
        Schema::dropIfExists('employee_file_details');
    }
}
