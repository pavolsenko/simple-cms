<?php

namespace App\BlogPost;


class EloquentBlogPostRepository implements BlogPostRepositoryInterface {

    private $blogPost;

    public function __construct(BlogPost $blogPost) {
        $this->blogPost = $blogPost;
    }

    public function createBlogPost($input) {

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
        $result = $this->blogPost->all();
        return $result;
    }

}