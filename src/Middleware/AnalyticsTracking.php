<?php

namespace Eduka\Cube\Middleware;

use Closure;
use Illuminate\Http\Request;

class AnalyticsTracking
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
