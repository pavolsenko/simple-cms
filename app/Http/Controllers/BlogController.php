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

    const NUMBER_OF_LATEST_POSTS = 5;
    const ROOT = 0;
    const BLOG_ROUTE = 'blog';
    const CATEGORY_ROUTE = 'blogCategory';

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

    public function indexBlog($id=self::ROOT) {
        if ($id === self::ROOT) {
            $posts = $this->blogPostService->getBlogPostsForHomepage();
        } else {
            $posts = $this->blogPostService->getBlogPostsByCategory($id);
        }

        $page = $this->request->get('page');
        if ($page == 1) {
            if ($this->request->route()->getName() == self::BLOG_ROUTE) {
                return $this->redirector->route(self::BLOG_ROUTE);
            } else {
                return $this->redirector->route(self::CATEGORY_ROUTE, ['id' => $id]);
            }
        }

        $categories = $this->blogPostService->getBlogCategoriesForHomepage();
        $latest_posts = $this->blogPostService->getLatestPosts(self::NUMBER_OF_LATEST_POSTS);

        return $this->view
            ->make('blog/homepage')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page'])
            ->with('categories', $categories)
            ->with('latest_posts', $latest_posts);
    }

    public function indexAdmin() {
        $posts = $this->blogPostService->getBlogPostsForAdmin();

        return $this->view
            ->make('admin/blogPosts/dashboard')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page']);
    }

    public function getUpdate($id) {
        $blog_post = $this->blogPostService->getBlogPostById($id);
        return $this->view->make('admin/blogPosts/createOrUpdate')->with('blog_post', $blog_post);
    }

    public function postUpdate() {
        $input = $this->request->all();
        $blog_post = $this->blogPostService->saveBlogPost($input);
        $message = trans('blogPost.saved');

        return $this->view
            ->make('admin/blogPosts/createOrUpdate')
            ->with('blog_post', $blog_post)
            ->with('message', $message);
    }

    public function getCreate() {
        return $this->view->make('admin/blogPosts/createOrUpdate');
    }

    public function postCreate() {
        $input = $this->request->only(['title', 'intro_text', 'body_text']);
        $blog_post = $this->blogPostService->saveBlogPost($input);
        $message = trans('blogPost.blog_post_saved');

        return $this->redirector
            ->route('getUpdateBlogPost', $blog_post['id'])
            ->with('blog_post', $blog_post)
            ->with('message', $message);
    }

    public function getDelete($id) {
        $this->blogPostService->deleteBlogPost($id);
        $message = trans('blogPost.blog_post_deleted');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getPublish($id) {
        $this->blogPostService->publishBlogPost($id);
        $message = trans('blogPost.blog_post_published');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getUnpublish($id) {
        $this->blogPostService->unpublishBlogPost($id);
        $message = trans('blogPost.blog_post_unpublished');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getBlogPost($id) {
        $blog_post = $this->blogPostService->getBlogPostById($id);

        return $this->view
            ->make('blog/singlePost')
            ->with('blog_post', $blog_post);
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

            return $this->redirector
                ->back()
                ->withErrors($this->validator)
                ->withInput();

        } else {

            $result = $this->blogPostService->postComment($input);
            if ($result) {
                $message = trans('comment.comment_submitted');
            } else {
                $message = trans('comment.comment_awaiting_approval');
            }

            return $this->redirector
                ->back()
                ->with('message', $message);
        }
    }

}
