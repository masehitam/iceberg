<?php

namespace app\Http\Middleware;

use Closure;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->getClientIp();
        $allowed = ['127.0.0.1'];

        if (app()->isDownForMaintenance() && !in_array($ip, $allowed)) {
            if (strstr($request->getRequestUri(), 'admin')) {
                if (!strstr($request->getRequestUri(), 'maintenance')) {
                    return response()->view('errors.admin.maintenance', [], 503);
                }
            } else {
                return response()->view('errors.default.maintenance', [], 503);
            }
        }

        return $next($request);
    }
}
