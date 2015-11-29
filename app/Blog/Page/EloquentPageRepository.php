<?php

namespace App\Blog\Page;

class EloquentPageRepository implements PageRepositoryInterface {

    protected $page;

    public function __construct(Page $page) {
        $this->page = $page;
    }

    public function getPageByUrl($url) {
        $page = null;

        return $page;
    }

    public function getPageById($id) {

        $page = null;

        return $page;
    }

    public function getAllPages() {
        $pages = $this->page->get();
        if (!is_null($pages)) {
            $pages = $pages->toArray();
        }
        return $pages;
    }
}

