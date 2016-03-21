<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateArticlesTable extends Migration
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
            $table->integer('contributor_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->string('title', 70);
            $table->string('slug', 100)->unique();
            $table->string('featured')->default('noimage.jpg');
            $table->text('content');
            $table->text('content_update')->nullable();
            $table->string('excerpt', 300)->nullable();
            $table->enum('type', ['standard', 'gallery', 'video'])->default('standard');
            $table->enum('status', ['pending', 'draft', 'published', 'reject'])->default('pending');
            $table->enum('state', ['general', 'headline', 'trending'])->default('general');
            $table->integer('view')->unsigned()->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('contributors')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            $table->index(['id', 'slug']);
        });

        DB::statement("ALTER TABLE articles MODIFY content LONGBLOB");
        DB::statement("ALTER TABLE articles MODIFY content_update LONGBLOB");
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
