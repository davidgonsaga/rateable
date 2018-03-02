<?php

namespace Webeleven\Rateable\Middleware;

use Closure;

class DefaultRateableAuth implements RateableAuth
{

    public function handle($request, Closure $next, $guard = null)
    {
        return $next($request);
    }
}