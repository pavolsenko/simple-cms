<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    protected $table = 'comment';

    public function author() {
        return $this->hasOne('comment_author', 'id', 'comment_author_id');
    }
}
