<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SocialProfile extends Model
{
    use SoftDeletes;

    protected $table = 'author_social_profile';

}