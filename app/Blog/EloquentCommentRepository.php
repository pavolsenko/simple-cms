<?php

namespace App\Blog;


class EloquentCommentRepository implements CommentRepositoryInterface {

    const APPROVED = 1;
    const WAITING = 0;

    private $comment;
    private $commentAuthor;

    public function __construct(Comment $comment, CommentAuthor $commentAuthor) {
        $this->comment = $comment;
        $this->commentAuthor = $commentAuthor;
    }

    public function createComment($input) {
        if ($this->spam_check($input)) {
            $status = self::WAITING;
        } else {
            $status = self::APPROVED;
        }
        $this->commentAuthor = $this->commentAuthor->where('email', $input['email'])->first();
        if (is_null($this->commentAuthor)) {
            $this->commentAuthor = new CommentAuthor();
            $this->commentAuthor->name = $input['name'];
            $this->commentAuthor->email = $input['email'];
            $this->commentAuthor->website = $input['website'];
            $this->commentAuthor->save();
        }
        $this->comment->comment_author_id = $this->commentAuthor->id;
        $this->comment->blog_post_id = $input['blog_post_id'];
        $this->comment->text = $input['text'];
        $this->comment->status = $status;
        $this->comment->save();
        return $status;
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

    private function spam_check($input) {
        if (!empty($input['website'])) {
            return true;
        } else {
            return false;
        }
    }

}