<?php

namespace App\Handler;


use App\Service\ApiClient;

class ContactHandler
{
    private $api;

    public function __construct(
        ApiClient $api
    ){
        $this->api = $api;
    }

    public function handle(array $data)
    {
        $response = $this->api->post('contact', $data);


    }

}