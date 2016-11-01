<?php

namespace Barryvanveen\LastfmApi;

use Barryvanveen\LastfmApi\Exceptions\ApiKeyRequiredException;
use Barryvanveen\LastfmApi\Exceptions\InvalidArgumentException;

class UrlBuilder
{
    protected $blocks = [];

    public function __construct()
    {
        if (empty(config('services.lastfm.key'))) {
            throw new ApiKeyRequiredException();
        }

        $this->setDefaultValues();

        return $this;
    }

    public function setDefaultValues()
    {
        $this->setApiKey(config('services.lastfm.key'));

        $this->setFormat(Constants::FORMAT);
    }

    /**
     * @param string $api_key
     *
     * @return $this
     */
    public function setApiKey($api_key)
    {
        $this->blocks[Constants::BLOCK_API_KEY] = $api_key;

        return $this;
    }

    /**
     * @param $format
     *
     * @return $this
     */
    public function setFormat($format)
    {
        $this->blocks[Constants::BLOCK_FORMAT] = $format;

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
        if (! UrlValidator::isValidMethod($method)) {
            throw new InvalidArgumentException('Invalid method specified');
        }

        $this->blocks[Constants::BLOCK_METHOD] = $method;

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function setUsername($username)
    {
        $this->blocks[Constants::BLOCK_USERNAME] = $username;

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
        if (! UrlValidator::isValidPeriod($period)) {
            throw new InvalidArgumentException('Invalid period specified');
        }

        $this->blocks[Constants::BLOCK_PERIOD] = $period;

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
        if (! UrlValidator::isPositiveInteger($limit)) {
            throw new InvalidArgumentException('Invalid limit specified');
        }

        $this->blocks[Constants::BLOCK_LIMIT] = $limit;

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
        if (! UrlValidator::isPositiveInteger($page)) {
            throw new InvalidArgumentException('Invalid page specified');
        }

        $this->blocks[Constants::BLOCK_PAGE] = $page;

        return $this;
    }

    /**
     * Reset specified given blocks or all blocks if none are specified.
     *
     * @param string $blocks
     *
     * @return $this
     */
    public function reset($blocks)
    {
        if ($blocks === false) {
            $this->resetAll();

            return $this;
        }

        if (isset($this->blocks[$blocks])) {
            unset($this->blocks[$blocks]);
        }

        return $this;
    }

    public function resetAll()
    {
        $this->blocks = [];

        $this->setDefaultValues();
    }

    public function buildUrl()
    {
        $blocks = $this->getBlocks();

        return $this->getRootUrl().$this->buildParameters($blocks);
    }

    protected function getBlocks()
    {
        return $this->blocks;
    }

    protected function getRootUrl()
    {
        return Constants::API_ROOT_URL.'/'.Constants::API_VERSION;
    }

    protected function buildParameters($blocks)
    {
        return '?'.http_build_query($blocks);
    }
}
