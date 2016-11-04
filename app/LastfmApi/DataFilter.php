<?php

namespace Barryvanveen\LastfmApi;

use Barryvanveen\LastfmApi\Exceptions\InvalidArgumentException;
use Barryvanveen\LastfmApi\Exceptions\ResponseException;
use Exception;

class DataFilter
{
    /** @var  string */
    protected $method;

    /** @var  array */
    protected $data;

    /**
     * @param $method
     * @param $data
     *
     * @return mixed
     * @throws ResponseException
     */
    public function filter($method, $data)
    {
        $this->method = $method;

        $this->data = $data;

        try {
            return $this->returnFilteredData();
        } catch (Exception $e) {
            throw new ResponseException("Response could not be filtered.");
        }
    }

    /**
     * @return array
     *
     * @throws InvalidArgumentException
     */
    protected function returnFilteredData()
    {
        switch ($this->method) {
            case Constants::METHOD_USER_INFO:
                return $this->data['user'];
            case Constants::METHOD_USER_RECENT_TRACKS:
                return $this->data['recenttracks']['track'];
            case Constants::METHOD_USER_NOW_LISTENING:
                return $this->filterNowListeningTrack();
            case Constants::METHOD_USER_TOP_ALBUMS:
                return $this->data['topalbums']['album'];
            case Constants::METHOD_USER_TOP_ARTISTS:
                return $this->data['topartists']['artist'];
        }

        throw new InvalidArgumentException("Method not set or unknown.");
    }

    /**
     * @return mixed
     */
    protected function filterNowListeningTrack()
    {
        $lastTrack = $this->data['recenttracks']['track'][0];

        if (!isset($lastTrack['@attr']['nowplaying'])) {
            return false;
        }

        if (!$lastTrack['@attr']['nowplaying']) {
            return false;
        }

        return $lastTrack;
    }


}
