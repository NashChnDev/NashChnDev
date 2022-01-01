<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('customercode')->nullable();
            $table->string('customername')->nullable();
            $table->string('customeremail')->nullable();
            $table->string('customermobile')->nullable();
            $table->string('customerphone')->nullable();
            $table->string('customeraddress')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('customergstinno')->nullable();
            $table->string('customerstatus')->nullable();
            $table->string('customerremarks')->nullable();
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
        Schema::drop('customers');
    }
}
