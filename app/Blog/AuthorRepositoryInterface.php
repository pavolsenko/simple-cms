<?php

namespace App\Blog;

interface AuthorRepositoryInterface {
    public function createAuthor($input);
    public function deleteAuthor($id);
    public function getAuthorById($id);
    public function getAllAuthors();
}
