<?php

namespace Barryvanveen\LastfmApi;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class DataFetcher
{
    /** @var Client */
    protected $client;

    /** @var ResponseInterface */
    protected $response;

    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
        ]);
    }

    public function get($url)
    {
        $this->response = $this->client->get($url);

        $this->validateResponse();

        return $this->response;
    }

    public function validateResponse()
    {
        if ($this->response->getStatusCode() == 200) {
            return;
        }

        // todo: throw exceptions when there was an error
    }
}
