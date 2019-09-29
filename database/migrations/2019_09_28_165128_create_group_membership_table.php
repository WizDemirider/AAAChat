<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_membership', function (Blueprint $table) {
            $table->unsignedBigInteger('group');
            $table->foreign('group')->references('id')->on('groups');
            $table->string('user');
            $table->foreign('user')->references('phone')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_membership');
    }
}
