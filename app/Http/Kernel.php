<?php
namespace Barryvanveen\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Barryvanveen\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Barryvanveen\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Spatie\GoogleTagManager\GoogleTagManagerMiddleware::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic'          => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth-post-ajax-json' => \Barryvanveen\Http\Middleware\AuthPostAjaxJson::class,
        'bindings'            => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'                 => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'               => \Barryvanveen\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'            => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
