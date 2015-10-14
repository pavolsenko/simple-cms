<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogPost extends Model
{
    use SoftDeletes;

    protected $table = 'blog_post';

    public function author() {
        return $this->hasOne('App\Blog\Author', 'author_id');
    }

    public function comments() {
        return $this->hasMany('App\Blog\Comment', 'blog_post_id');
    }
}
