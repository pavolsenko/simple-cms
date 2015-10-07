<?php

namespace App\Blog;


class EloquentAuthorRepository implements AuthorRepositoryInterface {

    private $author;

    public function __construct(Author $author) {
        $this->author = $author;
    }

    public function createAuthor($input) {

    }

    public function deleteAuthor($id) {

    }

    public function getAuthorById($id) {
        return $this->author
            ->where('id', $id)
            ->first()
            ->toArray();
    }

    public function getAllAuthors() {

    }

}