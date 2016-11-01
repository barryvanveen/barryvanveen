<?php

namespace Barryvanveen\LastfmApi;

class Constants
{

    const BLOCK_PERIOD = 'period';
    const BLOCK_USERNAME = 'username';
    const FORMAT = 'json';
    const BLOCK_FORMAT = 'format';
    const BLOCK_METHOD = 'method';
    const API_ROOT_URL = 'http://ws.audioscrobbler.com';
    const BLOCK_LIMIT = 'limit';
    const API_VERSION = '2.0';
    const BLOCK_PAGE = 'page';
    const BLOCK_API_KEY = 'api_key';
    const METHOD_USER_TOP_ALBUMS = 'user.gettopalbums';
    const PERIOD_YEAR = '12month';
    const PERIOD_MONTH = '1month';
    const VALID_PERIODS = [
        Constants::PERIOD_WEEK,
        Constants::PERIOD_MONTH,
        Constants::PERIOD_3_MONTHS,
        Constants::PERIOD_6_MONTHS,
        Constants::PERIOD_YEAR,
        Constants::PERIOD_EVER,
    ];
    const PERIOD_EVER = 'overall';
    const METHOD_USER_RECENT_TRACKS = 'user.getrecenttracks';
    const METHOD_USER_INFO = 'user.getinfo';
    const VALID_METHODS = [
        Constants::METHOD_USER_INFO,
        Constants::METHOD_USER_RECENT_TRACKS,
        Constants::METHOD_USER_TOP_ALBUMS,
        Constants::METHOD_USER_TOP_ARTISTS,
    ];
    const METHOD_USER_TOP_ARTISTS = 'user.gettopartists';
    const PERIOD_WEEK = '7day';
    const PERIOD_3_MONTHS = '3month';
    const PERIOD_6_MONTHS = '6month';
}