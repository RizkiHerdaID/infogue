<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author')->unsigned();
            $table->integer('label')->unsigned();
            $table->string('title', 70);
            $table->string('slug', 100)->unique();
            $table->string('featured')->default('noimage.jpg');
            $table->text('content');
            $table->text('content_update')->nullable();
            $table->string('excerpt', 300)->nullable();
            $table->enum('type', ['standard', 'gallery', 'video'])->default('standard');
            $table->enum('status', ['pending', 'draft', 'published', 'headline', 'trending'])->default('pending');
            $table->integer('view')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('author')->references('id')->on('contributors')->onDelete('cascade');
            $table->foreign('label')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
    }
}
