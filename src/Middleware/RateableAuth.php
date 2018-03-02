<?php

namespace Webeleven\Rateable\Middleware;

use Closure;

interface RateableAuth
{
    
    public function handle($request, Closure $next, $guard = null);

}