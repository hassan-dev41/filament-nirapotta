<?php

namespace HassanDev41\FilamentNirapotta\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use HassanDev41\FilamentNirapotta\Models\Permission;

class InstallAdminPermission extends Command
{
    protected $signature = 'nirapotta:install-permissions';
    protected $description = 'Install and update permissions based on Filament resources';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting permission installation...');

        // Get all Filament resources
        $resources = $this->getFilamentResources();
        
        if ($resources->isEmpty()) {
            $this->warn('No Filament resources found.');
            return Command::FAILURE;
        }

        $this->createPermissions($resources);

        $this->info('Permissions have been installed successfully!');
        return Command::SUCCESS;
    }

    /**
     * Get all Filament resources from the application.
     */
    protected function getFilamentResources(): Collection
    {
        $resourcePath = app_path(config('filament-nirapotta.resources_path'));
        
        if (!File::exists($resourcePath)) {
            return collect();
        }

        return collect(File::allFiles($resourcePath))
            ->map(function ($file) {
                $namespace = 'App\\' . str_replace(
                    ['/', '.php'],
                    ['\\', ''],
                    Str::after($file->getPathname(), app_path() . DIRECTORY_SEPARATOR)
                );

                return $namespace;
            })
            ->filter(function ($class) {
                return class_exists($class) && is_subclass_of($class, 'Filament\\Resources\\Resource');
            });
    }

    /**
     * Create permissions based on Filament resources.
     */
    protected function createPermissions(Collection $resources): void
    {
        $guard = config('filament-nirapotta.guard_name');
        $existingPermissions = Permission::where('guard_name', $guard)->pluck('name')->toArray();

        foreach ($resources as $resource) {
            $name = (new $resource())->getModelLabel();
            $slug = Str::slug($name);

            $permissions = [
                "view_{$slug}" => "View {$name}",
                "view_any_{$slug}" => "View Any {$name}",
                "create_{$slug}" => "Create {$name}",
                "update_{$slug}" => "Update {$name}",
                "delete_{$slug}" => "Delete {$name}",
                "delete_any_{$slug}" => "Delete Any {$name}",
                "force_delete_{$slug}" => "Force Delete {$name}",
                "force_delete_any_{$slug}" => "Force Delete Any {$name}",
                "restore_{$slug}" => "Restore {$name}",
                "restore_any_{$slug}" => "Restore Any {$name}",
            ];

            foreach ($permissions as $permissionName => $description) {
                if (!in_array($permissionName, $existingPermissions)) {
                    Permission::create([
                        'name' => $permissionName,
                        'slug' => Str::slug($permissionName),
                        'guard_name' => $guard,
                    ]);

                    $this->info("Created permission: {$permissionName}");
                }
            }
        }
    }
}