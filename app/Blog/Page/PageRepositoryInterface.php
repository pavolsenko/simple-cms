<?php

namespace App\Blog\Page;

interface PageRepositoryInterface {
    public function getPageByUrl($url);
    public function getPageById($id);
    public function getAllPages();
}
