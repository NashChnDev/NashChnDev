<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterGaugeissueheadersTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gaugeissueheaders', function(Blueprint $table)
        {
            $table->string('gaugeissuereqcode')->nullable();
            $table->string('gaugeissuereqname')->nullable();
            $table->string('gaugeissuereqdept')->nullable();
            $table->string('gaugeissuereqapprover')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gaugeissueheaders', function(Blueprint $table)
        {
            $table->dropColumn('gaugeissuereqcode');
            $table->dropColumn('gaugeissuereqname');
            $table->dropColumn('gaugeissuereqdept');
            $table->dropColumn('gaugeissuereqapprover');

        });
    }
}
