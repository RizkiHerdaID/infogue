<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContrbutorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token', 50)->unique();
            $table->rememberToken();
            $table->string('api_token', 60)->unique();
            $table->string('vendor', 50);
            $table->string('name', 50);
            $table->string('username', 20)->unique();
            $table->string('email', 50)->unique();
            $table->string('password', 60);
            $table->enum('status', ['pending', 'activated', 'suspended'])->default('pending');
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->string('avatar')->default('noavatar.jpg');
            $table->string('cover')->default('nocover.jpg');
            $table->date('birthday')->nullable();
            $table->string('about', 160)->nullable();
            $table->string('location', 30)->nullable();
            $table->string('contact', 20)->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('instagram')->nullable();
            $table->boolean('mobile_notification')->default(true);
            $table->boolean('email_subscription')->default(true);
            $table->boolean('email_message')->default(true);
            $table->boolean('email_follow')->default(true);
            $table->boolean('email_feed')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->index(['id', 'name', 'username']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contributors');
    }
}
