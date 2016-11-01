<?php

namespace Barryvanveen\LastfmApi;

use Barryvanveen\LastfmApi\Exceptions\ResponseException;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class DataFetcher
{
    /** @var Client */
    protected $client;

    /** @var ResponseInterface */
    protected $response;

    /** @var  array */
    protected $responseData;

    /**
     * DataFetcher constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'http_errors' => false,
        ]);
    }

    /**
     * Get, parse and validate a response from the given url.
     *
     * @param $url
     *
     * @return mixed
     */
    public function get($url)
    {
        $this->response = $this->client->get($url);

        $this->parseResponse();

        $this->validateResponse();

        return $this->responseData;
    }

    /**
     * Parse JSON response into an associative array.
     */
    protected function parseResponse()
    {
        $this->responseData = json_decode($this->response->getBody(), true);
    }

    /**
     * Throw an exception of the status code of the response is not 200 OK.
     *
     * @throws ResponseException
     */
    protected function validateResponse()
    {
        if ($this->response->getStatusCode() == 200 && !isset($this->responseData['error'])) {
            return;
        }

        $errorMessage = "Lastfm API error " . $this->responseData['error'] . ": " . $this->responseData['message'];

        throw new ResponseException($errorMessage);
    }
}
