<?php

namespace Barryvanveen\LastfmApi;

class UrlValidator
{

    /**
     * @param string $method
     *
     * @return bool
     */
    public static function isValidMethod($method)
    {
        if (in_array($method, Constants::VALID_METHODS)) {
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
        if (in_array($period, Constants::VALID_PERIODS)) {
            return true;
        }

        return false;
    }

    /**
     * Check if the value is number.
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
}
