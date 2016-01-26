<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory as View;
use App\Blog\Page\PageRepositoryInterface;
use App\Blog\Page\PageService;
use App\Blog\BlogService;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller {

    private $view;
    private $pageRepository;
    private $pageService;
    private $blogService;
    private $request;

    /**
     * PageController constructor injecting dependencies.
     */
    public function __construct(
        View $view,
        PageRepositoryInterface $pageRepositoryInterface,
        PageService $pageService,
        BlogService $blogService,
        Request $request
    ) {
        $this->view = $view;
        $this->pageRepository = $pageRepositoryInterface;
        $this->pageService = $pageService;
        $this->blogService = $blogService;
        $this->request = $request;
    }

    /**
     * @return View
     */
    public function indexAdmin() {
        $pages = $this->pageRepository->getAllPages();
        if (!empty($pages)) {
            $pages['data'] = null;
            $pages['last_page'] = 0;
            $pages['current_page'] = 0;
        }
        return $this->view
            ->make('admin/pages/dashboard')
            ->with('pages', $pages['data'])
            ->with('total_pages', $pages['last_page'])
            ->with('current_page', $pages['current_page']);

    }

    /**
     * @param null $id
     * @return $this
     */
    public function getCreateOrUpdate($id=null) {
        if (!is_null($id)) {
            $page = $this->pageService->getPageById($id);
        } else {
            $page = null;
        }
        return $this->view
            ->make('admin/pages/createOrUpdatePage')
            ->with('page', $page);
    }

    /**
     * @param $id
     */
    public function postCreateOrUpdate($id) {
        $input = $this->request->all();
        $rules = [
            'title' => 'required',
            'body_text' => 'required',
        ];
        $this->validator = $this->validator->make($input, $rules);
        if ($this->validator->fails()) {
            return $this->redirector
                ->back()
                ->withInput()
                ->withErrors($this->validator);
        } else {
            $blog_post = $this->blogService->saveBlogPost($input);
            $message = trans('blog.saved');
            $authors = $this->blogService->getAllAuthorsWithIds();
            $categories = $this->blogService->getAllCategoriesWithIds();
            $selected_categories = [];
            foreach ($blog_post['categories'] as $selected_category) {
                array_push($selected_categories, $selected_category['id']);
            }
            if ($input['close']) {
                return $this->redirector
                    ->route('postsDashboard');
            } else {
                return $this->view
                    ->make('admin/blogPosts/createOrUpdate')
                    ->with('blog_post', $blog_post)
                    ->with('authors', $authors)
                    ->with('categories', $categories)
                    ->with('selected_categories', $selected_categories)
                    ->with('message', $message);
            }
        }
    }

    /**
     *
     */
    public function getPublish() {

    }

    /**
     *
     */
    public function getUnpublish() {

    }

    /**
     * @param $url
     * @return $this|\Illuminate\Contracts\View\View
     */
    public function getPage($url) {
        $page = $this->pageRepository->getPageByUrl($url);
        if (is_null($page)) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            $meta = $this->blogService->getMetaTags($page);

            return $this->view
                ->make('singlePage')
                ->with('page', $page)
                ->with('meta_author', $meta['author'])
                ->with('meta_description', $meta['description'])
                ->with('meta_keywords', $meta['keywords'])
                ->with('meta_title', $meta['title']);
        }
    }

}