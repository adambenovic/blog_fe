<?php

namespace App\Handler;


use App\Decorator\CommentDecorator;
use App\Entity\Comment;
use App\Service\ApiClient;

class CommentsHandler
{
    /**
     * @var ApiClient
     */
    private $api;

    private $decorator;

    public function __construct(
        ApiClient $api,
        CommentDecorator $decorator
    ){
        $this->api = $api;
        $this->decorator = $decorator;
    }

    public function getHomepageComments()
    {
        $blogs = $this->api->get('comments');

        return $blogs;
    }

    public function getBlogComments(int $id)
    {
        $comments = $this->api->get('comments/' . $id);

        return $comments;
    }

    public function postComment(Comment $comment, $postId)
    {
        $authorId = 5;

        if($authorId == null)
            return null;

        $response = $this->api->post('comments', $this->decorator->decoratePostComment($comment, $postId, $authorId));

        return $response;
    }
}