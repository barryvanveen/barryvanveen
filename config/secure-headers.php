<?php

$protocol = 'https://';
if (! isset($_SERVER['HTTPS']) || 'off' == $_SERVER['HTTPS']) {
    $protocol = 'http://';
}

return [
    'x-content-type-options'            => 'nosniff',
    'x-download-options'                => 'noopen',
    'x-frame-options'                   => 'sameorigin',
    'x-permitted-cross-domain-policies' => 'none',
    'x-xss-protection'                  => '1; mode=block',
    'referrer-policy'                   => 'unsafe-url',
    'hsts'                              => [
        'enable'              => env('SECURITY_HEADER_HSTS_ENABLE', false),
        'max-age'             => 31536000,
        'include-sub-domains' => true,
    ],
    'hpkp' => [
        'hashes'              => false,
        'include-sub-domains' => false,
        'max-age'             => 15552000,
        'report-only'         => false,
        'report-uri'          => null,
    ],
    'custom-csp' => env('SECURITY_HEADER_CUSTOM_CSP', null),
    'csp'        => [
        'report-only'               => false,
        'report-uri'                => env('CONTENT_SECURITY_POLICY_REPORT_URI', false),
        'upgrade-insecure-requests' => false,
        'default-src'               => [
            'self' => true,
        ],
        'script-src' => [
            'self' => true,
            'allow' => [
                $protocol.'ajax.googleapis.com',
                $protocol.'code.jquery.com',
                $protocol.'www.googletagmanager.com',
                $protocol.'www.google-analytics.com',
            ],
            'hashes' => [
                'sha256' => [
                ],
            ],
            'schemes' => [
                'data:',
            ],
            'unsafe-inline' => config('app.debug'),
            'unsafe-eval'   => config('app.debug'),
            'add-generated-nonce' => ! config('app.debug'),
        ],
        'style-src' => [
            'self' => true,
            'allow' => [
                $protocol.'fonts.googleapis.com',
            ],
            'hashes' => [
                'sha256' => [
                ],
            ],
            'unsafe-inline' => config('app.debug'),
            'add-generated-nonce' => ! config('app.debug'),
        ],
        'img-src' => [
            'allow' => [
                $protocol.'www.google-analytics.com',
                'https://lastfm-img2.akamaized.net',
            ],
            'schemes' => [
                'data:',
            ],
            'self' => true,
        ],
        'font-src' => [
            'allow' => [
                $protocol.'fonts.gstatic.com',
            ],
            'schemes' => [
                'data:',
            ],
            'self' => true,
        ],
        'object-src' => [
            'allow' => [],
            'self'  => false,
        ],
    ],
];
