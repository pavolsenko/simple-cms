<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    protected $table = 'comment';

    public function author() {
        return $this->hasOne('App\Blog\CommentAuthor', 'id', 'comment_author_id');
    }

    public function blogPost() {
        return $this->belongsTo('BlogPost', 'blog_post_id');
    }
}
