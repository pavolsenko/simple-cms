<?php

namespace App\Blog;

use Illuminate\Contracts\Auth\Guard as Auth;

class EloquentBlogPostRepository implements BlogPostRepositoryInterface {

    const ENABLED = 1;
    const DISABLED = 0;
    const POSTS_PER_PAGE_BLOG = 10;
    const POSTS_PER_PAGE_ADMIN = 20;

    private $blogPost;
    private $auth;

    public function __construct(BlogPost $blogPost, Auth $auth) {
        $this->blogPost = $blogPost;
        $this->auth = $auth;
    }

    public function createBlogPost($input) {
        $this->blogPost->title = $input['title'];
        $this->blogPost->intro_text = $input['intro_text'];
        $this->blogPost->body_text = $input['body_text'];
        $this->blogPost->created_by = $this->auth->user()->getAuthIdentifier();
        $this->blogPost->last_updated_by = $this->auth->user()->getAuthIdentifier();
        //$this->blogPost->enabled = $input['enabled'];
        $this->blogPost->save();
        return $this->blogPost->toArray();
    }

    public function updateBlogPost($input) {
        $this->blogPost = $this->blogPost->where('id', $input['id'])->first();
        $this->blogPost->title = $input['title'];
        $this->blogPost->intro_text = $input['intro_text'];
        $this->blogPost->body_text = $input['body_text'];
        $this->blogPost->created_by = $this->auth->user()->getAuthIdentifier();
        $this->blogPost->last_updated_by = $this->auth->user()->getAuthIdentifier();
        //$this->blogPost->enabled = $input['enabled'];
        //$this->blogPost->url = $input['url'];
        $this->blogPost->save();
        return $this->blogPost->toArray();
    }

    public function deleteBlogPost($id) {
        $this->blogPost = $this->blogPost->where('id', $id)->first();
        return $this->blogPost->delete();
    }

    public function publishBlogPost($id) {
        $this->blogPost = $this->blogPost->where('id', $id)->first();
        $this->blogPost->enabled = self::ENABLED;
        return $this->blogPost->save();
    }

    public function unpublishBlogPost($id) {
        $this->blogPost = $this->blogPost->where('id', $id)->first();
        $this->blogPost->enabled = self::DISABLED;
        return $this->blogPost->save();
    }

    public function getBlogPostById($id) {
        return $this->blogPost
            ->where('id', $id)
            ->with(['author', 'author.social', 'comments', 'comments.author', 'categories'])
            ->first()
            ->toArray();
    }

    public function getBlogPostByAuthor($author) {

    }

    public function getAllBlogPosts($enabled_only=false) {
        if ($enabled_only) {
            $posts = $this->blogPost
                ->where('enabled', self::ENABLED)
                ->with(['author', 'comments'])
                ->orderBy('created_at', 'desc')
                ->paginate(self::POSTS_PER_PAGE_BLOG)
                ->toArray();
        } else {
            $posts = $this->blogPost
                ->orderBy('created_at', 'desc')
                ->paginate(self::POSTS_PER_PAGE_ADMIN)
                ->toArray();

        }
        return $posts;
    }

    public function getLatestPosts($number=5) {
        $posts = $this->blogPost
            ->with(['author'])
            ->where('enabled', self::ENABLED)
            ->orderBy('created_at', 'DESC')
            ->take($number)
            ->get();
        if (!is_null($posts)) {
            $posts = $posts->toArray();
        }
        return $posts;
    }

}