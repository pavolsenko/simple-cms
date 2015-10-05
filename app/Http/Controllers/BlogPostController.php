<?php

namespace App\Http\Controllers;

use App\BlogPost\BlogPostService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector;

class BlogPostController extends Controller
{

    private $blogPostService;
    protected $view;
    protected $request;
    private $redirector;

    public function __construct(BlogPostService $blogPostService, View $view, Request $request, Redirector $redirector) {
        $this->blogPostService = $blogPostService;
        $this->view = $view;
        $this->request = $request;
        $this->redirector = $redirector;
    }

    public function index()
    {
        $posts = $this->blogPostService->getBlogPostsForAdmin();
        return $this->view->make('admin/blogPosts/dashboard')->with('posts', $posts);
    }


    public function getCreate()
    {
        return $this->view->make('admin/blogPosts/createNew');
    }

    public function postCreate() {
        $input = $this->request->only(['title', 'intro_text', 'body_text']);
        $this->blogPostService->saveBlogPost($input);
        return $this->redirector->route('postsDashboard');
    }
}
