<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('logger_id')->index();
            $table->string('logger_type')->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('branch_id')->unsgined()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
