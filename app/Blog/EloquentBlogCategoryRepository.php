<?php

namespace App\Blog;

use Illuminate\Contracts\Auth\Guard as Auth;

class EloquentBlogCategoryRepository implements BlogCategoryRepositoryInterface {

    const ENABLED = 1;
    const DISABLED = 0;
    const CATEGORIES_PER_PAGE_ADMIN = 20;
    const POSTS_PER_PAGE_BLOG = 10;
    const POSTS_PER_PAGE_ADMIN = 20;

    private $blogCategory;
    private $auth;

    public function __construct(BlogCategory $blogCategory, Auth $auth) {
        $this->blogCategory = $blogCategory;
        $this->auth = $auth;
    }

    public function createBlogCategory($input) {

    }

    public function updateBlogCategory($input) {

    }

    public function deleteBlogCategory($id) {

    }

    public function publishBlogCategory($id) {

    }

    public function unpublishBlogCategory($id) {

    }

    public function getBlogPostsForCategory($id) {
        $category = $this->blogCategory
            ->where('id', $id)
            ->first();
        if (!is_null($category)) {
            $posts = $category
                ->posts()
                ->with(['author', 'comments'])
                ->where('enabled', self::ENABLED)
                ->paginate(self::POSTS_PER_PAGE_BLOG);
            $category = $category->toArray();
            if (!is_null($posts)) {
                $category['posts'] = $posts->toArray();
            }
        }
        dd($category);
        return $category;
    }

    public function getAllBlogCategories($enabled_only=false){
        if ($enabled_only) {
            $categories = $this->blogCategory
                ->with('posts')
                ->where('enabled', self::ENABLED)
                ->get();
        } else {
            $categories = $this->blogCategory->all();
        }
        if (!is_null($categories)) {
            $categories = $categories->toArray();
            foreach ($categories as &$category) {
                $category['posts'] = count($category['posts']);
            }
        }
        return $categories;
    }

}