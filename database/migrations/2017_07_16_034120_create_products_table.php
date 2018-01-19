<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('unitName')->nullable();
            $table->string('bundleName')->nullable();
            $table->integer('unitsPerBundle')->default(1)->unsigned();
            $table->string('category_id')->index();
            $table->integer('availableQuantity')->default(0);
            $table->float('buyingPrice', 10, 1)->default(0);
            $table->float('sellingPrice', 10, 1)->default(0);
            $table->integer('branch_id')->unsgined()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
