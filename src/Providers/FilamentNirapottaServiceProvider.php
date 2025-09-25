<?php

namespace HassanDev41\FilamentNirapotta\Providers;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use HassanDev41\FilamentNirapotta\Filament\Resources\PermissionResource;
use HassanDev41\FilamentNirapotta\Filament\Resources\RoleResource;

class FilamentNirapottaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register the admin guard
        $this->app['config']->set('auth.guards.admin', [
            'driver' => 'session',
            'provider' => 'users',
        ]);
        
        // Register middleware
        $this->app['router']->aliasMiddleware('admin.access', \HassanDev41\FilamentNirapotta\Middleware\AdminAccessMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament/admin/theme.css');
        });

        // Register resources when Filament boots
        \Filament\Facades\Filament::registerResources([
            PermissionResource::class,
            RoleResource::class,
        ]);

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'filament-nirapotta-migrations');

        // Publish config
        $this->publishes([
            __DIR__ . '/../../config/filament-nirapotta.php' => config_path('filament-nirapotta.php'),
        ], 'filament-nirapotta-config');

        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/filament-nirapotta.php', 'filament-nirapotta'
        );
        
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \HassanDev41\FilamentNirapotta\Commands\InstallAdminPermission::class,
            ]);
        }
    }
}