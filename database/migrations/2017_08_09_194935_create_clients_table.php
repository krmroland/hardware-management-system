<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('phoneNumber')->nullable();
            $table->integer('accountBalance')->default(0);
            $table->unique(['phoneNumber', 'name', 'client_type', 'branch_id']);
            $table->string('client_type')->index();
            $table->integer('branch_id')->unsgined()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
