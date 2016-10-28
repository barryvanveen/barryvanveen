<?php

namespace Barryvanveen\LastfmApiClient;

use Barryvanveen\LastfmApiClient\Exceptions\ApiKeyRequiredException;
use Barryvanveen\LastfmApiClient\Exceptions\InvalidLimitException;
use Barryvanveen\LastfmApiClient\Exceptions\InvalidPeriodException;

class LastfmApiClient
{
    const API_ROOT_URL = 'http://ws.audioscrobbler.com';

    const API_VERSION = '2.0';

    const FORMAT = 'json';

    const VALID_PERIODS = [
        '7day',
        '1month',
        '3month',
        '6month',
        '12month',
        'overall',
    ];

    protected $api_key;

    protected $username;

    protected $method;

    protected $period;

    protected $limit;

    /**
     * LastfmApiClient constructor.
     *
     * @throws ApiKeyRequiredException
     */
    public function __construct()
    {
        if (empty(config('services.lastfm.key'))) {
            throw new ApiKeyRequiredException();
        }

        $this->api_key = config('services.lastfm.key');

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function userTopAlbums($username)
    {
        if (empty($username)) {
            // todo: throw exception?
        }

        $this->username = $username;

        $this->method = 'user.gettopalbums';

        return $this;
    }

    /**
     * @param string $period
     *
     * @throws InvalidPeriodException
     *
     * @return $this
     */
    public function period($period)
    {
        if (! self::isValidPeriod($period)) {
            throw new InvalidPeriodException();
        }

        $this->period = $period;

        return $this;
    }

    /**
     * @param $period
     *
     * @return bool
     */
    protected static function isValidPeriod($period)
    {
        if (in_array($period, self::VALID_PERIODS)) {
            return true;
        }

        return false;
    }

    /**
     * @param $limit
     *
     * @throws InvalidLimitException
     *
     * @return $this
     */
    public function limit($limit)
    {
        // todo: fix this
        /*if ( ! self::isValidInteger($limit)) {
            throw new InvalidLimitException();
        }*/

        $this->limit = $limit;

        return $this;
    }

    /**
     * Check if the value is number.
     *
     * @param $value
     *
     * @return bool
     */
    protected static function isValidInteger($value)
    {
        if (preg_match('/^([0-9]+)$/', $value) > 1) {
            return true;
        }

        return false;
    }

    public function get()
    {
        $url = $this->buildUrl();

        dd($url);
    }

    protected function buildUrl()
    {
        // is username set?
        // is method set?
        // is period set?
        // is limit set?
        // is page set?

        return self::API_ROOT_URL.'/'.self::API_VERSION.'/?method='.$this->method.
                                                              '&user='.$this->username.
                                                              '&period='.$this->period.
                                                              '&limit='.$this->limit.
                                                              '&api_key='.$this->api_key.
                                                              '&format='.self::FORMAT;
    }
}
