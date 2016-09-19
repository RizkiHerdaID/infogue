<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('contributor_id')->unsigned();
            $table->enum('type', ['withdrawal', 'reward']);
            $table->string('description', 1000);
            $table->decimal('amount');
            $table->enum('status', ['pending', 'proceed', 'cancel', 'success']);
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('contributors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
