<?php

namespace App\Http\Middleware;

use Closure;

class AfterMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         echo "after Middleware";
        return $next($request);
    }
}
