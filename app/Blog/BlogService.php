<?php namespace App\Blog;


class BlogService {

    const ENABLED_ONLY = true;
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
        if (empty($input['url'])) {
            $input['url'] = $this->urlService->createUrlFromTitle($input['title']);
        } else {
            $input['url'] = $this->urlService->createUrlFromTitle($input['url']);
        }
        if (isset($input['id'])) {
            $blog_post = $this->blogPostRepository->updateBlogPost($input);
        } else {
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


    public function getAllCategoriesWithIds() {
        $categories = $this->blogCategoryRepository->getAllBlogCategories();
        $result = [];
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $result[$category['id']] = $category['title'];
            }
        }
        return $result;
    }

    public function getMetaTags($blog_post) {
        $meta = [];

        $meta['author'] = $blog_post['author']['first_name'].' '.$blog_post['author']['last_name'];

        if (!empty($blog_post['meta_title'])) {
            $meta['title'] = $blog_post['meta_title'];
        } else {
            $meta['title'] = $blog_post['title'];
        }

        if (!empty($blog_post['meta_description'])) {
            $meta['description'] = $blog_post['meta_description'];
        } else {
            $meta['description'] = substr(strip_tags($blog_post['intro_text']), 0, 200).'...';
        }

        $meta['keywords'] = null; //TODO: default keywords or don't care about them anymore?

        return $meta;
    }

    public function getAvatarUrl($email) {
        $url = '//www.gravatar.com/avatar/'.md5(strtolower(trim($email))).'?d=identicon';
        return $url;
    }
}
