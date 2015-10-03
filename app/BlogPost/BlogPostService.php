<?php namespace App\BlogPost;

class BlogPostService {

    private $blogPostRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepositoryInterface) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
    }

    public function getBlogPostsForHomepage() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    public function getBlogPostsForAdmin() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    public function getBlogPostsByCategory() {

    }

    public function getBlogPostById($id) {
        return $this->blogPostRepository->getBlogPostById($id);
    }

}