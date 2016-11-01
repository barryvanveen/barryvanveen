<?php

namespace Barryvanveen\Http\Middleware;

use Closure;
use HttpException;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class AuthPostAjaxJson
{
    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param \Closure $next
     *
     * @throws HttpException
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->isMethod('post') || ! $request->ajax() || ! $request->wantsJson()) {
            throw new MethodNotAllowedException([]);
        }

        return $next($request);
    }
}
