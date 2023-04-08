<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserController;
use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param String $level
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $level) {

        $res = UserController::auth((int)$level);

        if(!$res) return $next($request);
        else return $res;
    }
}
