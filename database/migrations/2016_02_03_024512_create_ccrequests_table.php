<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCcrequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ccrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('upline_id')->unsigned();
            $table->string('email')->nullable()->comment = "old email";
            $table->string('req_email')->nullable()->comment = "Requested email";
            $table->string('phone')->nullable()->comment = "old phone";
            $table->string('req_phone')->nullable()->comment = "Requested phone";
            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ccrequests');
    }
}
