<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->increments('id');
            $table->nullableMorphs('client');
            $table->timestamp('date')->nullable();
            $table->integer('product_id')->index()->unsigned();
            $table->integer('paid');
            $table->integer('subTotal');
            $table->integer('quantity');
            $table->integer('buyingPrice');
            $table->integer('sellingPrice');
            $table->string('receipt')->nullable()->index();
            $table->string('type')->index();
            $table->integer('branch_id')->unsgined()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('trades');
    }
}
