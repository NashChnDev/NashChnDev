<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeePrimaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_primary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email',255);
            $table->string('email_secondary',255)->nullable();
            $table->date('date_birth')->nullable();
            $table->enum('gender',array('Male','Female','Others'))->nullable();
            $table->string('blood_group',100)->nullable();
            $table->enum('martial_status',array('Single','Married','Widowed','Divorced','Separated'))->nullable();            
            $table->string('Mobile_no',255)->nullable();    
            $table->string('religion',255)->nullable();    
            $table->string('Mobile_no_secondary',255)->nullable();    
            $table->string('language_known',255)->nullable();    
            $table->text('present_address')->nullable();    
            $table->text('permanent_address')->nullable();    
            $table->string('employee_id',200)->nullable();                                
            $table->string('company_unit', 100)->nullable();
            $table->string('department', 100)->nullable();
            $table->string('designation', 100)->nullable();
            $table->date('date_interview')->nullable();
            $table->date('date_joining')->nullable();             
            $table->string('mail_status',100)->nullable();
            $table->string('percentage_of_details',100)->nullable();                        
            $table->enum('status', array(0, 1));
            $table->enum('previous_employee',array('No','Yes'))->nullable();
            $table->text('previous_employee_details')->nullable();
            $table->enum('relative_working',array('No','Yes'))->nullable();
            $table->text('relative_working_details')->nullable();
            $table->enum('major_illness',array('No','Yes'))->nullable();
            $table->text('major_illness_details')->nullable();
            $table->enum('any_court_law',array('No','Yes'))->nullable();
            $table->text('any_court_law_details')->nullable();   
            $table->string('basic_cs_mon',100)->nullable();
            $table->string('basic_cs_ann',100)->nullable();
            $table->string('da_cs_mon',100)->nullable();
            $table->string('da_cs_ann',100)->nullable();
            $table->string('allowance_cs_mon',100)->nullable();
            $table->string('allowance_cs_ann',100)->nullable();
            $table->string('monthlygross_cs_mon',100)->nullable();
            $table->string('monthlygross_cs_ann',100)->nullable();
            $table->string('annualbene_cs_mon',100)->nullable();
            $table->string('annualbene_cs_ann',100)->nullable();
            $table->string('others_cs_mon',100)->nullable();
            $table->string('others_cs_ann',100)->nullable();
            $table->string('profile_img',300)->nullable();
            $table->string('param1',100)->nullable(); 
            $table->string('param2',100)->nullable();
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
        Schema::dropIfExists('employee_primary');
    }
}
