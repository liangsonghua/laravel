<?php

namespace App\Http\Middleware;

use Closure;

class BeforeMiddleWare
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
        //处理权限问题和授权
        echo "before Middleware";
        return $next($request);
    }
}
