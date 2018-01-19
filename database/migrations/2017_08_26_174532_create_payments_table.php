<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('branch_id')->unsgined()->index();
            $table->increments('id');
            $table->morphs('client');
            $table->morphs('payer');
            $table->integer('balanceBefore');
            $table->integer('balanceAfter');
            $table->integer('supposedToPay');
            $table->integer('excessPay');
            $table->integer('paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
