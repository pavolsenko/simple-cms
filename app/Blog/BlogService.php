<?php namespace App\Blog;


class BlogService {

    const ENABLED_ONLY = TRUE;
    const NUMBER_OF_RELATED_POSTS = 5;

    private $blogPostRepository;
    private $blogCategoryRepository;
    private $authorRepository;
    private $commentRepository;
    private $urlService;

    public function __construct(BlogPostRepositoryInterface $blogPostRepositoryInterface, BlogCategoryRepositoryInterface $blogCategoryRepositoryInterface, AuthorRepositoryInterface $authorRepositoryInterface, CommentRepositoryInterface $commentRepositoryInterface, UrlService $urlService) {
        $this->blogPostRepository = $blogPostRepositoryInterface;
        $this->blogCategoryRepository = $blogCategoryRepositoryInterface;
        $this->authorRepository = $authorRepositoryInterface;
        $this->commentRepository = $commentRepositoryInterface;
        $this->urlService = $urlService;
    }

    public function getBlogPostsForHomepage() {
        $posts = $this->blogPostRepository->getAllBlogPosts(self::ENABLED_ONLY);
        return $posts;
    }

    public function getBlogPostsForAdmin() {
        return $this->blogPostRepository->getAllBlogPosts();
    }

    public function getBlogPostsByCategory($category_id) {
        return $this->blogCategoryRepository->getBlogPostsForCategory($category_id);
    }

    public function getBlogCategoriesForHomepage() {
        return $this->blogCategoryRepository->getAllBlogCategories(self::ENABLED_ONLY);
    }

    public function getBlogCategoriesForAdmin() {
        return $this->blogCategoryRepository->getAllBlogCategories();
    }

    public function getBlogPostById($id) {
        $post = $this->blogPostRepository->getBlogPostById($id);
        return $post;
    }

    public function saveBlogPost($input) {
        if (isset($input['id'])) {
            $blog_post = $this->blogPostRepository->updateBlogPost($input);
        } else {
            $input['url'] = $this->urlService->createUrlFromTitle($input['title']);
            $blog_post = $this->blogPostRepository->createBlogPost($input);
        }
        return $blog_post;
    }

    public function deleteBlogPost($id) {
        return $this->blogPostRepository->deleteBlogPost($id);
    }

    public function publishBlogPost($id) {
        return $this->blogPostRepository->publishBlogPost($id);
    }

    public function unpublishBlogPost($id) {
        return $this->blogPostRepository->unpublishBlogPost($id);
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

    public function getLatestPosts($count) {
        return $this->blogPostRepository
            ->getLatestPosts($count);
    }

    public function getBlogCategoryById($id) {
        return $this->blogCategoryRepository->getBlogCategoryById($id);
    }

    public function getRelatedBlogPosts($post_id, $category_id, $number=self::NUMBER_OF_RELATED_POSTS) {
        $posts = $this->getBlogPostsByCategory($category_id);
        $result = [];
        for ($ii = 0; $ii < $number; $ii++) {
            $post_key = rand(0, count($posts['data']));
            if (!is_null($posts['data']) && isset($posts['data'][$post_key])) {
                if ($posts['data'][$post_key]['id'] != $post_id) {
                    array_push($result, $posts['data'][$post_key]);
                    unset($posts['data'][$post_key]);
                }
            }
        }
        return $result;
    }

    public function getAllAuthorsWithIds() {
        $authors = $this->authorRepository->getAllAuthors();
        $result = [];
        if (!empty($authors)) {
            foreach ($authors as $author) {
                $result[$author['id']] = $author['first_name'].' '.$author['last_name'];
            }
        }
        return $result;
    }

}
