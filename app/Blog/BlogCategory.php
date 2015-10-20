<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table = 'blog_category';

    public function posts() {
        return $this->belongsToMany('App\Blog\BlogPost', 'blog_post_blog_category');
    }

}

