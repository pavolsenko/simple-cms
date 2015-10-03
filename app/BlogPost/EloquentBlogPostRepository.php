<?php

namespace App;


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

    }

    public function getBlogPostByCategory($category) {
    }

    public function getBlogPostByAuthor($author) {

    }

}