<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Contracts\View\Factory as View;
use App\Blog\Page\PageRepositoryInterface;

class PageController extends Controller {

    protected $view;
    protected $pageRepository;

    public function __construct(View $view, PageRepositoryInterface $pageRepositoryInterface) {
        $this->view = $view;
        $this->pageRepository = $pageRepositoryInterface;
    }

    public function getPage($url) {
        $page = $this->pageRepository->getPage($url);
        if (is_null($page)) {
            return $this->view
                ->make('errors/404', [], [404]);
        } else {
            return null;
        }
    }

}