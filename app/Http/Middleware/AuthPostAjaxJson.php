<?php

namespace Barryvanveen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Response;

class AuthPostAjaxJson
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('post') || !$request->ajax() || !$request->wantsJson()) {
            return Response::make('Unauthorized', 401);
        }

        return $next($request);
    }
}
