<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterVendorsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendors', function(Blueprint $table)
        {
            $table->string('vendorcode')->nullable();
            $table->string('vendorgstino')->nullable();
            $table->string('vendorlocation')->nullable();
            $table->string('vendorstatus')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->string('company_city')->nullable();
            $table->string('vendorGstinNo')->nullable();
            $table->string('vendorrRemarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendors', function(Blueprint $table)
        {
            $table->dropColumn('vendorcode');
            $table->dropColumn('vendorgstino');
            $table->dropColumn('vendorlocation');
            $table->dropColumn('vendorstatus');
            $table->dropColumn('company_country');
            $table->dropColumn('company_state');
            $table->dropColumn('company_city');
            $table->dropColumn('vendorGstinNo');
            $table->dropColumn('vendorrRemarks');

        });
    }
}
