<?php

if (!function_exists('lastfmMediumThumb')) {
    /**
     * Return the medium sized thumbnail from a LastFm array.
     * Works on albums, artists, tracks and users.
     *
     * @param array $object
     *
     * @return string
     */
    function lastfmMediumThumb($object)
    {
        return $object['image'][1]['#text'] ?? '';
    }
}
