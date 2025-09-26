<?php

namespace HassanDev41\FilamentNirapotta\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\PermissionRegistrar;

class FilamentNirapottaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/filament-nirapotta.php',
            'filament-nirapotta'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish configuration
        $this->publishes([
            __DIR__ . '/../../config/filament-nirapotta.php' => config_path('filament-nirapotta.php'),
        ], 'filament-nirapotta-config');

        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \HassanDev41\FilamentNirapotta\Commands\InstallAdminPermission::class,
            ]);
        }

        // Register Resources
        Filament::registerResources([
            \HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource::class,
        ]);

        // Clear permission cache on boot
        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}