<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class PreventRequestsDuringMaintenance
{
    public function handle($request, Closure $next)
    {
        if ($this->appIsInMaintenanceMode()) {
            // throw new MaintenanceModeException;
        }

        return $next($request);
    }

    protected function appIsInMaintenanceMode()
    {
        return app()->isDownForMaintenance();
    }
}