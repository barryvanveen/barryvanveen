<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Tag Manager code
    |--------------------------------------------------------------------------
    |
    | This is the Google Tag Manager code that the website uses.
    |
    */
    'gtm_code' => env('GTM_CODE'),

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
