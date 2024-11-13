<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{

	public function handle(Request $request, Closure $next, string $guards): Response
{
    $guardsArray = explode(',', $guards);

    foreach ($guardsArray as $guard) {
        if (Auth::guard($guard)->check()) {
            return redirect($guard . '/dashboard');
        }
    }

    return $next($request);
}


}