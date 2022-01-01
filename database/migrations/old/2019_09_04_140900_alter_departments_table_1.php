<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterDepartmentsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departments', function(Blueprint $table)
        {
            $table->string('deptcode')->nullable();
            $table->string('deptphone')->nullable();
            $table->string('deptaddress')->nullable();
            $table->string('deptincharge')->nullable();
            $table->string('deptstatus')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departments', function(Blueprint $table)
        {
            $table->dropColumn('deptcode');
            $table->dropColumn('deptphone');
            $table->dropColumn('deptaddress');
            $table->dropColumn('deptincharge');
            $table->dropColumn('deptstatus');

        });
    }
}
