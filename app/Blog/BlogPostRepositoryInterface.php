<?php

namespace App\Blog;

interface BlogPostRepositoryInterface {
    public function createBlogPost($input);
    public function updateBlogPost($input);
    public function deleteBlogPost($id);
    public function getBlogPostById($id);
    public function getBlogPostByCategory($category);
    public function getBlogPostByAuthor($author);
    public function getAllBlogPosts($enabled_only=false);
}
