<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('company_code')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_mobile')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_gstinno')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
