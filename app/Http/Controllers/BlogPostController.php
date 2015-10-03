<?php

namespace App\Http\Controllers;

use App\BlogPost\BlogPostService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\View\Factory as View;

class BlogPostController extends Controller
{

    private $blogPostService;
    protected $view;

    public function __construct(BlogPostService $blogPostService, View $view) {
        $this->blogPostService = $blogPostService;
        $this->view = $view;
    }

    public function index()
    {
        $posts = $this->blogPostService->getBlogPostsForAdmin();

        return $this->view->make('admin/blogPosts/dashboard')->with('posts', compact($posts));
    }


    public function getCreate()
    {
        return $this->view->make('admin/blogPosts/createNew');
    }

    public function postCreate($input) {

    }
}
