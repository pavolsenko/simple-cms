<?php

namespace App\Http\Controllers;

use App\Blog\BlogPostService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory as Validator;

class BlogController extends Controller
{

    private $blogPostService;
    protected $view;
    protected $request;
    private $redirector;
    private $validator;

    public function __construct(BlogPostService $blogPostService, View $view, Request $request, Redirector $redirector, Validator $validator) {
        $this->blogPostService = $blogPostService;
        $this->view = $view;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->validator = $validator;
    }

    public function indexBlog() {
        $page = $this->request->get('page');
        if ($page == 1) {
            return $this->redirector->route('blog');
        }

        $posts = $this->blogPostService->getBlogPostsForHomepage();
        return $this->view
            ->make('blog/homepage')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page']);
    }

    public function indexAdmin() {
        $posts = $this->blogPostService->getBlogPostsForAdmin();

        return $this->view
            ->make('admin/blogPosts/dashboard')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page']);
    }


    public function getCreate() {
        return $this->view->make('admin/blogPosts/createNew');
    }

    public function postCreate() {
        $input = $this->request->only(['title', 'intro_text', 'body_text']);
        $this->blogPostService->saveBlogPost($input);

        return $this->redirector->route('postsDashboard');
    }

    public function getBlogPost($id) {
        $blog_post = $this->blogPostService->getBlogPostById($id);

        return $this->view->make('blog/singlePost')->with('blog_post', $blog_post);
    }

    public function postComment() {
        $input = $this->request->only(['blog_post_id', 'name', 'email', 'website', 'text']);
        $rules = array(
            'name' => 'required|min:3',
            'email' => 'required|email',
            'website' => 'url',
            'text' => 'required|min:3|max:500'
        );
        $this->validator = $this->validator->make($input, $rules);
        if ($this->validator->fails()) {
            return $this->redirector->back()->withErrors($this->validator)->withInput();
        } else {
            $result = $this->blogPostService->postComment($input);
            if ($result) {
                $message = trans('comment.comment_submitted');
            } else {
                $message = trans('comment.comment_awaiting_approval');
            }
            return $this->redirector->back()->with('message', $message);
        }
    }
}
