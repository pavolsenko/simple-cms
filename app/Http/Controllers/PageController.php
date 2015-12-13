<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\View\Factory as View;
use App\Blog\Page\PageRepositoryInterface;
use App\Blog\Page\PageService;

class PageController extends Controller {

    private $view;
    private $pageRepository;
    private $pageService;

    public function __construct(View $view, PageRepositoryInterface $pageRepositoryInterface, PageService $pageService) {
        $this->view = $view;
        $this->pageRepository = $pageRepositoryInterface;
        $this->pageService = $pageService;
    }

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

    public function postCreateOrUpdate($id) {

    }

    public function getPublish() {

    }

    public function getUnpublish() {

    }

    public function getPage($url) {
        $page = $this->pageRepository->getPageByUrl($url);
        if (is_null($page)) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            return $this->view
                ->make('singlePage')
                ->with('page', $page);
        }
    }

}