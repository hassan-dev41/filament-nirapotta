<?php

namespace HassanDev41\FilamentNirapotta\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated with admin guard
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('login');
        }

        // Check if user has admin access permission
        $user = Auth::guard('admin')->user();
        if (!$user->hasPermissionTo(config('filament-nirapotta.admin_permission'))) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}