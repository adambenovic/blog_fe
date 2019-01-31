<?php

namespace App\Service;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiClient
 * @package App\Service
 */
class ApiClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * ApiClient constructor.
     * @param $url
     * @param $port
     */
    public function __construct(
        $url,
        $port
    ){
        $this->client = new Client([
            'base_uri' => $url . ":" . $port . "/api/",
            'timeout'  => 10.0,
        ]);
    }

    /**
     * @param string $uri
     * @return mixed
     */
    public function get(string $uri)
    {
        $response = $this->client->get($uri);
        $decode = $this->decode($response);

        return $decode;
    }

    /**
     * @param string $uri
     * @param array $data
     * @return mixed
     */
    public function post(string $uri, array $data)
    {
        $options = [
          RequestOptions::JSON => $data
        ];

        $response = $this->client->post($uri, $options);
        $decode = $this->decode($response);

        return $decode;
    }

    /**
     * @param ResponseInterface $response
     * @return mixed|string
     */
    protected function decode(ResponseInterface $response)
    {
        $data = (string)$response->getBody();
        $data = json_decode($data, true);

        return $data['data'];
    }
}