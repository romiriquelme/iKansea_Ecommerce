<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class UserRedirectIfAuthenticated
{
    /**
    * Handle  an incoming request.
    * @param \Illuminate\Http\Request $request
    * @param \Closure(\Illuminate\Http\Request):
    (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)   $next
    * @param string|null    ...$guards
    * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    */
    
	public function handle(Request $request, Closure $next, ...$guards)
    {

        if(Auth::check()){
            $expireTime = Carbon::now()->addSecond(30);
            Cache::put('user-online' . Auth::user()->id, true, $expireTime);
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }

        if(Auth::check() && Auth::user()){
            return $next($request);
            
        }else{
            return redirect()->route('login');
        }
    }
}