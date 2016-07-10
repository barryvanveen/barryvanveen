<?php
namespace Barryvanveen\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Barryvanveen\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Barryvanveen\Http\Middleware\VerifyCsrfToken::class,
        \Spatie\GoogleTagManager\GoogleTagManagerMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                => \Barryvanveen\Http\Middleware\Authenticate::class,
        'auth.basic'          => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth-post-ajax-json' => \Barryvanveen\Http\Middleware\AuthPostAjaxJson::class,
        'guest'               => \Barryvanveen\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}
