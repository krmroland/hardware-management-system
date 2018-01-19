<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('branch_users', function (Blueprint $table) {
            $table->integer('user_id')->index()->unsigned();
            $table->boolean('isDefault')->default(false);
            $table->integer('branch_id')->index()->unsigned();
            $table->unique(['user_id', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('branch_users');
    }
}
