<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BlogPost extends Model
{
    use SoftDeletes;

    protected $table = 'blog_post';

    public function author() {
        return $this->hasOne('App\Blog\Author', 'id', 'author_id');
    }

    public function comments() {
        return $this->hasMany('App\Blog\Comment', 'blog_post_id');
    }

    public function categories() {
        return $this->belongsToMany('App\Blog\BlogCategory', 'blog_post_blog_category')->withPivot('blog_post_id')->withTimestamps();
    }
}
