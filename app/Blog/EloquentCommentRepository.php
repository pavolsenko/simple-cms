<?php

namespace App\Blog;


class EloquentCommentRepository implements CommentRepositoryInterface {

    const APPROVED = 1;
    const WAITING = 0;

    private $comment;


    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }

    public function createComment($input) {

    }

    public function deleteComment($id) {

    }

    public function getCommentsByBlogPostId($id) {
        return $this->comment->where('blog_post_id', $id)->toArray();
    }

    public function getAllComments() {
        return $this->comment->all()->toArray();
    }

    public function getWaitingComments(){
        return $this->comment->where('status', self::WAITING)->toArray();
    }

    public function getApprovedComments(){
        return $this->comment->where('status', self::APPROVED)->toArray();
    }

}