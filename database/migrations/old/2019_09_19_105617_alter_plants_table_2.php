<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterPlantsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plants', function(Blueprint $table)
        {
            $table->integer('company_id')->unsigned()->nullable()->index();
            $table->string('status')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function(Blueprint $table)
        {
            $table->dropColumn('company_id');
            $table->dropColumn('status');

        });
    }
}
