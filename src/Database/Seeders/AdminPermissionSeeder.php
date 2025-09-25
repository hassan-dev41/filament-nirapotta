<?php

namespace HassanDev41\FilamentNirapotta\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin access permission
        Permission::firstOrCreate(['name' => config('filament-nirapotta.admin_permission'), 'guard_name' => config('filament-nirapotta.guard')]);
        
        // Create admin role if it doesn't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => config('filament-nirapotta.guard')]);
        
        // Assign admin permission to admin role
        $adminRole->givePermissionTo(config('filament-nirapotta.admin_permission'));
    }
}