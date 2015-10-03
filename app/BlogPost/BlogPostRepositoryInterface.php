<?php

namespace App\BlogPost;

interface BlogPostRepositoryInterface {
    public function createBlogPost($input);
    public function deleteBlogPost($id);
    public function getBlogPostById($id);
    public function getBlogPostByCategory($category);
    public function getBlogPostByAuthor($author);
    public function getAllBlogPosts();
}
