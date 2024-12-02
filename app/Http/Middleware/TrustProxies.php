<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Middleware\TrustProxies as BaseMiddleware;

class TrustProxies extends BaseMiddleware
{
    protected $proxies = '*'; // Trust all proxies

    // protected $headers = Request::HEADER_X_FORWARDED_ALL;
}