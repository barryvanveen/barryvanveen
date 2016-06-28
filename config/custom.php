<?php

return [

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
