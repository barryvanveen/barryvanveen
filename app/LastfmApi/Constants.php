<?php

namespace Barryvanveen\LastfmApi;

class Constants
{
    const API_ROOT_URL = 'http://ws.audioscrobbler.com';
    const API_VERSION = '2.0';
    const FORMAT = 'json';

    const BLOCK_API_KEY = 'api_key';
    const BLOCK_FORMAT = 'format';
    const BLOCK_LIMIT = 'limit';
    const BLOCK_METHOD = 'method';
    const BLOCK_PAGE = 'page';
    const BLOCK_PERIOD = 'period';
    const BLOCK_USERNAME = 'username';

    const PERIOD_WEEK = '7day';
    const PERIOD_MONTH = '1month';
    const PERIOD_3_MONTHS = '3month';
    const PERIOD_6_MONTHS = '6month';
    const PERIOD_YEAR = '12month';
    const PERIOD_EVER = 'overall';

    const VALID_PERIODS = [
        self::PERIOD_WEEK,
        self::PERIOD_MONTH,
        self::PERIOD_3_MONTHS,
        self::PERIOD_6_MONTHS,
        self::PERIOD_YEAR,
        self::PERIOD_EVER,
    ];

    const METHOD_USER_INFO = 'user.getinfo';
    const METHOD_USER_NOW_LISTENING = 'user.getrecenttracks';
    const METHOD_USER_RECENT_TRACKS = 'user.getrecenttracks';
    const METHOD_USER_TOP_ALBUMS = 'user.gettopalbums';
    const METHOD_USER_TOP_ARTISTS = 'user.gettopartists';

    const VALID_METHODS = [
        self::METHOD_USER_INFO,
        self::METHOD_USER_NOW_LISTENING,
        self::METHOD_USER_RECENT_TRACKS,
        self::METHOD_USER_TOP_ALBUMS,
        self::METHOD_USER_TOP_ARTISTS,
    ];
}
