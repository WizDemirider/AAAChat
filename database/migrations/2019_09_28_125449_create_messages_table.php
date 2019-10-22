<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('P2PMsgs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sender');
            $table->foreign('sender')->references('phone')->on('users')->onDelete('CASCADE');
            $table->string('receiver');
            $table->foreign('receiver')->references('phone')->on('users')->onDelete('CASCADE');
            $table->text('message')->nullable();
            $table->unsignedBigInteger('file')->nullable();
            $table->foreign('file')->references('id')->on('files');
            $table->boolean('read');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('P2PMsgs');
    }
}
