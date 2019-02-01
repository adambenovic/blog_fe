<?php

namespace App\Handler;

use App\Decorator\ContactDecorator;
use App\Service\ApiClient;

class ContactHandler
{
    private $api;
    private $contactDecorator;

    public function __construct(
        ApiClient $api,
        ContactDecorator $contactDecorator
    ){
        $this->api = $api;
        $this->contactDecorator = $contactDecorator;
    }

    public function handle(array $data)
    {
        $this->api->post('contact', $this->contactDecorator->decorate($data));
        //TODO Check response if sending was sucessfull, return accordingly
    }
}
