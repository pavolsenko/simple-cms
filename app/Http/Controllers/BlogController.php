<?php

namespace App\Http\Controllers;

use App\Blog\BlogService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\View\Factory as View;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Factory as Validator;

class BlogController extends Controller
{

    const NUMBER_OF_LATEST_POSTS = 5;
    const BLOG_ROOT_ID = 0;
    const BLOG_ROUTE = 'blog';
    const CATEGORY_ROUTE = 'blogCategory';

    private $blogService;
    protected $view;
    protected $request;
    private $redirector;
    private $validator;

    public function __construct(BlogService $blogService, View $view, Request $request, Redirector $redirector, Validator $validator) {
        $this->blogService = $blogService;
        $this->view = $view;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->validator = $validator;
    }

    public function indexBlog($id=self::BLOG_ROOT_ID, $url=null) {

        $page = $this->request->get('page');
        if ($id == self::BLOG_ROOT_ID) {
            if ($page == 1) {
                return $this->redirector->route(self::BLOG_ROUTE);
            } else {
                $category = null;
                $posts = $this->blogService->getBlogPostsForHomepage();
            }
        } else {
            $category = $this->blogService->getBlogCategoryById($id);
            if ($page == 1) {
                return $this->redirector->route(self::CATEGORY_ROUTE, ['id' => $id, 'url' => $category['url']]);
            } else {
                $posts = $this->blogService->getBlogPostsByCategory($id);
            }
        }
        $categories = $this->blogService->getBlogCategoriesForHomepage();
        $latest_posts = $this->blogService->getLatestPosts(self::NUMBER_OF_LATEST_POSTS);

        if ($id != self::BLOG_ROOT_ID && ($category == null || $category['url'] != $url)) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            return $this->view
                ->make('blog/homepage')
                ->with('category', $category)
                ->with('posts', $posts['data'])
                ->with('total_pages', $posts['last_page'])
                ->with('current_page', $posts['current_page'])
                ->with('categories', $categories)
                ->with('latest_posts', $latest_posts);
        }
    }

    public function indexAdmin() {
        $posts = $this->blogService->getBlogPostsForAdmin();

        return $this->view
            ->make('admin/blogPosts/dashboard')
            ->with('posts', $posts['data'])
            ->with('total_pages', $posts['last_page'])
            ->with('current_page', $posts['current_page']);
    }

    public function getUpdate($id) {
        $blog_post = $this->blogService->getBlogPostById($id);
        $authors = $this->blogService->getAllAuthorsWithIds();
        return $this->view
            ->make('admin/blogPosts/createOrUpdate')
            ->with('blog_post', $blog_post)
            ->with('authors', $authors);
    }

    public function getCreate() {
        $authors = $this->blogService->getAllAuthorsWithIds();
        return $this->view
            ->make('admin/blogPosts/createOrUpdate')
            ->with('authors', $authors);
    }

    public function postCreateOrUpdate() {
        $input = $this->request->all();
        $rules = [
            'title' => 'required',
            'intro_text' => 'required',
            'body_text' => 'required'
        ];
        $this->validator = $this->validator->make($input, $rules);
        if ($this->validator->fails()) {
            return $this->redirector
                ->back()
                ->withInput()
                ->withErrors($this->validator);
        } else {
            $blog_post = $this->blogService->saveBlogPost($input);
            $message = trans('blog.saved');
            $authors = $this->blogService->getAllAuthorsWithIds();
            return $this->view
                ->make('admin/blogPosts/createOrUpdate')
                ->with('blog_post', $blog_post)
                ->with('authors', $authors)
                ->with('message', $message);
        }
    }

    public function getDelete($id) {
        $this->blogService->deleteBlogPost($id);
        $message = trans('blog.blog_post_deleted');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getPublish($id) {
        $this->blogService->publishBlogPost($id);
        $message = trans('blog.blog_post_published');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getUnpublish($id) {
        $this->blogService->unpublishBlogPost($id);
        $message = trans('blog.blog_post_unpublished');

        return $this->redirector
            ->route('postsDashboard')
            ->with('message', $message);
    }

    public function getBlogPost($id, $url) {
        $blog_post = $this->blogService->getBlogPostById($id);
        if (is_null($blog_post) || $blog_post['url'] != $url) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            $related_posts = $this->blogService->getRelatedBlogPosts($id, $blog_post['categories'][rand(0, count($blog_post['categories']) - 1)]['id']);
            return $this->view
                ->make('blog/singlePost')
                ->with('blog_post', $blog_post)
                ->with('related_posts', $related_posts);
        }
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

            $result = $this->blogService->postComment($input);
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
