<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Google Analytics code
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
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
        'name' => env('MAIL_EXCEPTION_TO_NAME', null),
    ],

];