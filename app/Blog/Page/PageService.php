<?php namespace App\Blog\Page;

class PageService {

    private $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepositoryInterface) {
        $this->pageRepository = $pageRepositoryInterface;
    }

    public function getPageById($id) {
        return $this->pageRepository->getPageById($id);
    }
}