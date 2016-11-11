<?php

namespace Barryvanveen\LastfmApi;

use Barryvanveen\LastfmApi\Exceptions\InvalidArgumentException;

class LastfmApiClient
{
    /** @var UrlBuilder  */
    protected $urlBuilder;

    /** @var DataFetcher  */
    protected $dataFetcher;

    /** @var DataFilter  */
    protected $dataFilter;

    /** @var  string */
    protected $method;

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

    /**
     * @return array
     */
    public function get()
    {
        $url = $this->urlBuilder->buildUrl();

        $data = $this->dataFetcher->get($url);

        return $this->dataFilter->filter($this->method, $data);
    }

    /**
     * @return bool|array
     * @throws InvalidArgumentException
     */
    public function getNowListening()
    {
        if ($this->method != Constants::METHOD_USER_RECENT_TRACKS) {
            throw new InvalidArgumentException("Can not retrieve nowListening. Set the userRecentTracks method first");
        }

        $recentTracks = $this->get();

        $lastTrack = $recentTracks[0];

        if (! isset($lastTrack['@attr']['nowplaying'])) {
            return false;
        }

        if (! $lastTrack['@attr']['nowplaying']) {
            return false;
        }

        return $lastTrack;
    }
}
