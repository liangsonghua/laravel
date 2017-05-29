<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Respons;
class CheckRole
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
        $u = UsersRepository::findOrFail($request->id);
        if(Auth::user()->role === $u->role) {
            return $next($request);
        } else {
            return response('您没有权限，请联系管理员', 200)
                  ->header('Content-Type', 'text/plain');
        }
        
    }
}
