<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterBlogpostTable extends Migration
{

    public function up()
    {
        Schema::table('blog_post', function(Blueprint $table)
        {
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_post', function(Blueprint $table)
        {
            $table->dropColumn('url');
        });
    }
}
