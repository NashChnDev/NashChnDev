<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('gaugecode')->nullable();
            $table->string('attachmenttype')->nullable();
            $table->string('docdate')->nullable();
            $table->string('filename')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('attachments');
    }
}
