<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterVendorsTable2 extends Migration
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
            $table->integer('company_id')->unsigned()->nullable()->index();
            $table->dropColumn('vendorGstinNo');

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
            $table->dropColumn('company_id');
            $table->string('vendorGstinNo')->nullable();

        });
    }
}
