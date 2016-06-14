<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('deposit_id')->unsigned();
            $table->string('member_account');
            $table->decimal('amount', 10,2);
            $table->string('paid_from')->nullable();
            $table->timestamp('date');
            $table->tinyInteger('status')->comment = "0 nopayment 1 payment";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paymentinfos');
    }
}
