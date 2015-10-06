<?php namespace App\Blog;


class BlogPostService {

    private $blogPostRepository;
    private $urlService;

    public function __construct(BlogPostRepositoryInterface $blogPostRepositoryInterface, UrlService $urlService) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
        $this->urlService = $urlService;
    }

    public function getBlogPostsForHomepage() {
        $posts = $this->blogPostRepository->getAllBlogPosts();
        foreach ($posts as &$post) {
            $post['url'] = $this->urlService->createUrlFromIdAndTitle($post['id'], $post['title']);
        }
        return $posts;
    }

    public function getBlogPostsForAdmin() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    public function getBlogPostsByCategory() {

    }

    public function getBlogPostById($id) {
        return $this->blogPostRepository->getBlogPostById($id);
    }

    public function saveBlogPost($input) {


        if (isset($input['id'])) {

        } else {
            $this->blogPostRepository->createBlogPost($input);
        }
    }
}