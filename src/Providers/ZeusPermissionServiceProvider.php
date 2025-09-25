<?php

namespace Zeus\Permission\Providers;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Zeus\Permission\Filament\Resources\PermissionResource;
use Zeus\Permission\Filament\Resources\RoleResource;

class ZeusPermissionServiceProvider extends ServiceProvider
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
        $this->app['router']->aliasMiddleware('admin.access', \Zeus\Permission\Middleware\AdminAccessMiddleware::class);
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
        ], 'zeus-permission-migrations');

        // Publish config
        $this->publishes([
            __DIR__ . '/../../config/zeus-permission.php' => config_path('zeus-permission.php'),
        ], 'zeus-permission-config');

        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/zeus-permission.php', 'zeus-permission'
        );
        
        // Register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Zeus\Permission\Commands\InstallAdminPermission::class,
            ]);
        }
    }
}