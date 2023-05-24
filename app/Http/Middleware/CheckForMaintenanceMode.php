<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckForMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (app()->isDownForMaintenance()) {
        //     return response('Ứng dụng đang trong quá trình bảo trì. Vui lòng quay lại sau.', 503);
        // }
        
        if (env('APP_MAINTENANCE_MODE'))
        {
            return response('Ứng dụng đang trong quá trình bảo trì. Vui lòng quay lại sau.', 503);
        }
        
        return $next($request);
    }
}
