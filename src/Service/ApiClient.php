<?php

namespace App;


use GuzzleHttp\Client;

class ApiClient
{
    private $client;

    public function __construct(
        $url,
        $port
    ){
        $this->client = new Client([
            'base_uri' => $url . ":" . $port . "/api/",
            'timeout'  => 2.0,
        ]);
    }
}