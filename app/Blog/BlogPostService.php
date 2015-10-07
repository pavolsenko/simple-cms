<?php namespace App\Blog;


class BlogPostService {

    const ENABLED_ONLY = TRUE;

    private $blogPostRepository;
    private $urlService;

    public function __construct(BlogPostRepositoryInterface $blogPostRepositoryInterface, UrlService $urlService) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
        $this->urlService = $urlService;
    }

    public function getBlogPostsForHomepage() {
        $posts = $this->blogPostRepository->getAllBlogPosts(self::ENABLED_ONLY);
        foreach ($posts['posts'] as &$post) {
            $post['url'] = $post['id'].$post['url'];
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
            $input['url'] = $this->urlService->createUrlFromTitle($input['title']);
            $this->blogPostRepository->createBlogPost($input);
        }
    }
}