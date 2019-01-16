<?php

namespace App\Handler;


use App\Service\ApiClient;
use Symfony\Component\HttpFoundation\Request;

class PostsHandler
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

    public function getHomepagePosts()
    {
        $blogs = $this->api->get('posts');

        return $blogs;
    }

    public function getSearchPosts(Request $request)
    {
        $querry = $request->get('q');
        $blogs = $this->api->get('posts/search?q=' . $querry);

        return $blogs;
    }

}