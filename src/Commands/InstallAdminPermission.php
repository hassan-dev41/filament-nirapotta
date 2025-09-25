<?php

namespace HassanDev41\FilamentNirapotta\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InstallAdminPermission extends Command
{
    protected $signature = 'nirapotta:install';
    
    protected $description = 'Install admin permission and role for Filament access';
    
    public function handle()
    {
        $this->info('Installing Filament Nirapotta package...');
        
        // Create admin access permission
        $permission = Permission::firstOrCreate([
            'name' => config('filament-nirapotta.admin_permission', 'access_admin_panel'),
            'guard_name' => config('filament-nirapotta.guard', 'admin')
        ]);
        
        $this->info('Created permission: ' . $permission->name);
        
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate([
            'name' => 'admin', 
            'guard_name' => config('filament-nirapotta.guard', 'admin')
        ]);
        
        $this->info('Created role: ' . $adminRole->name);
        
        // Assign admin permission to admin role
        $adminRole->givePermissionTo($permission);
        
        $this->info('Assigned permission to admin role');
        $this->info('Filament Nirapotta package installed successfully!');
        
        return Command::SUCCESS;
    }
}