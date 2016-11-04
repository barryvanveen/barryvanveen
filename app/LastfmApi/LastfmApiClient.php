<?php

namespace Barryvanveen\LastfmApi;

class LastfmApiClient
{
    protected $urlBuilder;

    protected $dataFetcher;

    protected $dataFilter;

    protected $method;

    protected $nowListening = false;

    /**
     * LastfmApi constructor.
     */
    public function __construct()
    {
        $this->urlBuilder = new UrlBuilder();

        $this->dataFetcher = new DataFetcher();

        $this->dataFilter = new DataFilter();

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function userTopAlbums($username)
    {
        $this->setMethod(Constants::METHOD_USER_TOP_ALBUMS);

        $this->urlBuilder->setUsername($username);

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function userTopArtists($username)
    {
        $this->setMethod(Constants::METHOD_USER_TOP_ARTISTS);

        $this->urlBuilder->setUsername($username);

        return $this;
    }

    public function userRecentTracks($username)
    {
        $this->setMethod(Constants::METHOD_USER_RECENT_TRACKS);

        $this->urlBuilder->setUsername($username);

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function userInfo($username)
    {
        $this->setMethod(Constants::METHOD_USER_INFO);

        $this->urlBuilder->setUsername($username);

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function nowListening($username)
    {
        $this->setMethod(Constants::METHOD_USER_NOW_LISTENING);

        $this->urlBuilder->setUsername($username);

        return $this;
    }

    /**
     * @param string $method
     */
    protected function setMethod($method)
    {
        $this->method = $method;

        $this->urlBuilder->setMethod($method);
    }

    /**
     * @param int $period
     *
     * @return $this
     */
    public function period($period)
    {
        $this->urlBuilder->setPeriod($period);

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->urlBuilder->setLimit($limit);

        return $this;
    }

    /**
     * @param int $page
     *
     * @return $this
     */
    public function page($page)
    {
        $this->urlBuilder->setPage($page);

        return $this;
    }

    /**
     * Reset specified given blocks or all blocks if none are specified.
     *
     * @param mixed $blocks
     *
     * @return $this
     */
    public function reset($blocks = false)
    {
        $this->urlBuilder->reset($blocks);

        return $this;
    }

    public function get()
    {
        $url = $this->urlBuilder->buildUrl();

        $data = $this->dataFetcher->get($url);

        return $this->dataFilter->filter($this->method, $data);
    }

}
