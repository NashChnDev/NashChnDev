<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_personal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('temp_empid')->unsigned();
            $table->string('firstname', 150)->nullable();
            $table->string('middlename', 150)->nullable();
            $table->string('lastname', 150)->nullable();
            $table->string('dob', 150)->nullable();
            $table->string('gender', 100)->nullable();
            $table->string('bloodgroup', 100)->nullable();
            $table->string('martialstatus', 100)->nullable();
            $table->date('anniversary_date',100)->nullable();
            $table->string('differently_abled', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->string('differently_abled_type', 100)->nullable();
            $table->text('differently_assistance')->nullable();
            $table->string('email_id', 100)->nullable();
            $table->string('mobileno', 100)->nullable();
            $table->string('landlineno', 100)->nullable();
            $table->string('alternate_mobile', 100)->nullable();
            $table->text('present_address')->nullable();
            $table->string('present_country',150)->nullable();
            $table->string('present_state',150)->nullable();
            $table->string('present_city',150)->nullable();
            $table->string('present_pincode',150)->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('permanent_country',150)->nullable();
            $table->string('permanent_state',150)->nullable();
            $table->string('permanent_city',150)->nullable();
            $table->string('permanent_pincode',150)->nullable();
            $table->string('total_family_members',150)->nullable();
            $table->text('family_details')->nullable();
            $table->string('mothertongue',150)->nullable();
            $table->string('total_language',150)->nullable();
            $table->text('language_details')->nullable();
            $table->string('pancard_no',150)->nullable();
            $table->string('aadhar_card_no',150)->nullable();
            $table->string('pancard_file',150)->nullable();
            $table->string('aadhar_card_file',150)->nullable();
            $table->text('pesonal_description')->nullable();
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
        Schema::dropIfExists('employee_personal');
    }
}
