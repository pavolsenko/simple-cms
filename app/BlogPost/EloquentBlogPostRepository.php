<?php

namespace App\BlogPost;

use Illuminate\Contracts\Auth\Guard as Auth;

class EloquentBlogPostRepository implements BlogPostRepositoryInterface {

    const ENABLED = 1;
    const DISABLED = 0;

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
        $this->blogPost->enabled = self::ENABLED;
        return $this->blogPost->save();
    }

    public function deleteBlogPost($id) {

    }

    public function getBlogPostById($id) {
        return $this->blogPost->all()->where('id', $id)->toArray();
    }

    public function getBlogPostByCategory($category) {
    }

    public function getBlogPostByAuthor($author) {

    }

    public function getAllBlogPosts() {
        return $this->blogPost->all()->toArray();
    }

}