<?php

namespace App\Decorator;


use App\Entity\Comment;

class CommentDecorator
{
    private function decorate(string $comment, int $pid, int $aid)
    {
        return [
            'post_id' => $pid,
            'author_id' => $aid,
            'comment' => $comment,
        ];
    }

    public function decoratePostComment(Comment $comment, int $postId, int $authorId)
    {
        return $this->decorate($comment->getComment(), $postId, $authorId);
    }
}