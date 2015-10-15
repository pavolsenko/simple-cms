<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'author';

    public function social() {
        return $this->hasMany('App\Blog\SocialProfile', 'author_id');
    }
}
