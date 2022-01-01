<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterProductionLinesTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('production_lines', function(Blueprint $table)
        {
            $table->string('lineincharge')->nullable();
            $table->string('lineemailid')->nullable();
            $table->string('linestatus')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('production_lines', function(Blueprint $table)
        {
            $table->dropColumn('lineincharge');
            $table->dropColumn('lineemailid');
            $table->dropColumn('linestatus');

        });
    }
}
