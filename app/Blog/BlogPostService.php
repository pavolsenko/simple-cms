<?php namespace App\Blog;


class BlogPostService {

    const ENABLED_ONLY = TRUE;

    private $blogPostRepository;
    private $authorRepository;
    private $commentRepository;
    private $urlService;

    public function __construct(BlogPostRepositoryInterface $blogPostRepositoryInterface, AuthorRepositoryInterface $authorRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface, UrlService $urlService) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
        $this->authorRepository = $authorRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
        $this->urlService = $urlService;
    }

    public function getBlogPostsForHomepage() {
        $posts = $this->blogPostRepository->getAllBlogPosts(self::ENABLED_ONLY);
        foreach ($posts['posts'] as &$post) {
            $post['url'] = $post['id'].$post['url'];
            $post['author'] = $this->getPostAuthor($post['created_by']);
        }
        return $posts;
    }

    public function getBlogPostsForAdmin() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    public function getBlogPostsByCategory() {

    }

    public function getBlogPostById($id) {
        $post = $this->blogPostRepository->getBlogPostById($id);
        $post['author'] = $this->getPostAuthor($post['created_by']);
        return $post;
    }

    public function saveBlogPost($input) {


        if (isset($input['id'])) {

        } else {
            $input['url'] = $this->urlService->createUrlFromTitle($input['title']);
            $this->blogPostRepository->createBlogPost($input);
        }
    }

    private function getPostAuthor($id) {
        return $this->authorRepository->getAuthorById($id);
    }

    public function postComment($input) {
        $result = $this->commentRepository->createComment($input);
        if ($result) {
            $message = trans('comment.comment_sent');
        } else {
            $message = trans('comment.awaiting_approval');
        }
        return $message;
    }
}