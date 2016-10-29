<?php

namespace Barryvanveen\LastfmApi;

class UrlValidator
{
    const VALID_PERIODS = [
        '7day',
        '1month',
        '3month',
        '6month',
        '12month',
        'overall',
    ];

    const VALID_METHODS = [
        'user.gettopalbums',
    ];

    /**
     * @param string $method
     *
     * @return bool
     */
    public static function isValidMethod($method)
    {
        if (in_array($method, self::VALID_METHODS)) {
            return true;
        }

        return false;
    }

    /**
     * @param $period
     *
     * @return bool
     */
    public static function isValidPeriod($period)
    {
        if (in_array($period, self::VALID_PERIODS)) {
            return true;
        }

        return false;
    }

    /**
     * Check if the value is number
     *
     * @param $value
     *
     * @return bool
     */
    public static function isPositiveInteger($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false || $value <= 0) {
            return false;
        }

        return true;
    }

    /**
     * @param array $blocks
     */
    public static function validateBlocks($blocks)
    {
        if (!isset($blocks['method'])) {

        }
    }

}
