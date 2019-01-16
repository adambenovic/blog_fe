<?php

namespace App\Handler;


use App\Service\ApiClient;

class CommentsHandler
{
    /**
     * @var ApiClient
     */
    private $api;

    public function __construct(
        ApiClient $api
    ){
        $this->api = $api;
    }

    public function getHomepageComments()
    {
        $blogs = $this->api->get('comments');

        return $blogs;
    }
}