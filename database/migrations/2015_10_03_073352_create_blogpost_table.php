<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogpostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('intro_text');
            $table->text('body_text');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('last_updated_by')->unsigned();
            $table->boolean('enabled');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('blog_post', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('last_updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post');
    }
}
