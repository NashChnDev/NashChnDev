<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResignerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resigner', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();  
            $table->string('empcode', 150)->nullable();  
            $table->string('plant', 150)->nullable();  
            $table->string('department', 150)->nullable();  
            $table->string('resigned_date', 150)->nullable();  
            $table->text('reason_for_resigned')->nullable();  
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
        Schema::dropIfExists('resigner');
    }
}
