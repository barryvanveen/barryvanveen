<?php

namespace Barryvanveen\LastfmApi;

use Barryvanveen\LastfmApi\Exceptions\ApiKeyRequiredException;
use Barryvanveen\LastfmApi\Exceptions\InvalidArgumentException;

class UrlBuilder
{

    CONST API_ROOT_URL = 'http://ws.audioscrobbler.com';

    CONST API_VERSION = '2.0';

    const FORMAT = 'json';

    protected $api_key;

    protected $blocks = [
        'format' => self::FORMAT,
    ];

    public function __construct()
    {
        if (empty(config('services.lastfm.key'))) {
            throw new ApiKeyRequiredException();
        }

        $this->api_key = config('services.lastfm.key');

        return $this;
    }

    /**
     * @param string $method
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setMethod($method)
    {
        if (!UrlValidator::isValidMethod($method)) {
            throw new InvalidArgumentException("Invalid method specified");
        }

        $this->blocks['method'] = $method;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->blocks['username'] = $username;

        return $this;
    }

    /**
     * @param string $period
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        if (!UrlValidator::isValidPeriod($period)) {
            throw new InvalidArgumentException("Invalid period specified");
        }

        $this->blocks['period'] = $period;

        return $this;
    }

    /**
     * @param $limit
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setLimit($limit)
    {
        if (!UrlValidator::isPositiveInteger($limit)) {
            throw new InvalidArgumentException("Invalid limit specified");
        }

        $this->blocks['limit'] = $limit;

        return $this;
    }

    /**
     * @param $page
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function setPage($page)
    {
        if (!UrlValidator::isPositiveInteger($page)) {
            throw new InvalidArgumentException("Invalid page specified");
        }

        $this->blocks['page'] = $page;

        return $this;
    }

    public function buildUrl()
    {
        $blocks = $this->getBlocks();

        //UrlValidator::validateBlocks($blocks);

        return $this->getRootUrl() . $this->buildParameters($blocks);

        /*return self::API_ROOT_URL . '/' . self::API_VERSION . '/?method=' . $this->method .
        '&user=' . $this->username .
        '&period=' . $this->period .
        '&limit=' . $this->limit .
        '&page=' . $this->page .
        '&api_key=' . $this->api_key .
        '&format=' . self::FORMAT;*/
    }

    protected function getBlocks()
    {
        return $this->blocks;
    }

    protected function getRootUrl()
    {
        return self::API_ROOT_URL .'/'. self::API_VERSION;
    }

    protected function buildParameters($blocks)
    {
        return '?' . http_build_query($blocks);
    }

}