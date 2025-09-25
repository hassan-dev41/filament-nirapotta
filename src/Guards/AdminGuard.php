<?php

namespace HassanDev41\FilamentNirapotta\Guards;

use Illuminate\Auth\SessionGuard;

class AdminGuard extends SessionGuard
{
    /**
     * Determine if the current user has admin access.
     *
     * @return bool
     */
    public function hasAdminAccess()
    {
        $user = $this->user();
        
        if (!$user) {
            return false;
        }
        
        // Check if user has the admin permission
        return $user->hasPermissionTo(config('filament-nirapotta.admin_permission'));
    }
}