<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics code
    |--------------------------------------------------------------------------
    |
    | This is the Google Analytics code that the website uses.
    |
    */
    'google_analytics_code' => env('GA_CODE'),

    /*
    |--------------------------------------------------------------------------
    | Exception notification addressee
    |--------------------------------------------------------------------------
    |
    | This is the email address that all exceptions will be emailed to.
    |
    */

    'exception_to' => [
        'address' => env('MAIL_EXCEPTION_TO_ADDRESS', null),
        'name'    => env('MAIL_EXCEPTION_TO_NAME', null),
    ],

];
