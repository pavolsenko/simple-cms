<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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

    /**
     * PageController constructor injecting dependencies.
     */
    public function __construct(View $view, PageRepositoryInterface $pageRepositoryInterface, PageService $pageService, BlogService $blogService) {
        $this->view = $view;
        $this->pageRepository = $pageRepositoryInterface;
        $this->pageService = $pageService;
        $this->blogService = $blogService;
    }

    /**
     * @return $this
     */
    public function indexAdmin() {
        $pages = $this->pageRepository->getAllPages();
        if (!empty($pages)) {
            return $this->view
                ->make('admin/pages/dashboard')
                ->with('pages', $pages['data'])
                ->with('total_pages', $pages['last_page'])
                ->with('current_page', $pages['current_page']);
        } else {
            return $this->view
                ->make('admin/pages/dashboard')
                ->with('pages', null)
                ->with('total_pages', 0);
        }
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