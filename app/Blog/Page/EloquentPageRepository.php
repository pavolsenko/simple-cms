<?php

namespace App\Blog\Page;

class EloquentPageRepository implements PageRepositoryInterface {

    const ENABLED = 1;
    const PAGES_PER_PAGE_ADMIN = 20;

    protected $page;

    public function __construct(Page $page) {
        $this->page = $page;
    }

    public function getPageByUrl($url) {
        $page = $this->page
            ->where('url', $url)
            ->where('enabled', self::ENABLED)
            ->first();
        if (!is_null($page)) {
            $page = $page->toArray();
        }
        return $page;
    }

    public function getPageById($id) {
        $page = $this->page
            ->where('id', $id)
            ->first();
        if (!is_null($page)) {
            $page = $page->toArray();
        }
        return $page;
    }

    public function getAllPages() {
        $pages = $this->page
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGES_PER_PAGE_ADMIN);
        if (!is_null($pages)) {
            $pages = $pages->toArray();
        }
        return $pages;
    }
}

