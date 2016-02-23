<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id')->unsigned();
            $table->integer('sender')->unsigned();
            $table->integer('receiver')->unsigned();
            $table->text('message');
            $table->boolean('is_available_sender')->default(true);
            $table->boolean('is_available_receiver')->default(true);
            $table->timestamps();

            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('sender')->references('id')->on('contributors')->onDelete('cascade');
            $table->foreign('receiver')->references('id')->on('contributors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conversations');
    }
}
