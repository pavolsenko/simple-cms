<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogPostServiceProvider extends ServiceProvider
{

    public function register() {
        \App::bind('App\BlogPostRepositoryInterface', 'App\EloquentBlogPostRepository');
    }

}
