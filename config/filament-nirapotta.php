<?php

return [
    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This is the User model used by FilamentNirapotta. You can override it with
    | your own User model that extends the base User model.
    |
    */
    'user_model' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | This is the navigation group where the User and Role management links will
    | be placed in the Filament admin panel.
    |
    */
    'navigation_group' => 'User Management',

    /*
    |--------------------------------------------------------------------------
    | Resources Path
    |--------------------------------------------------------------------------
    |
    | This is the path where Filament will look for the admin panel resources.
    | If you want to use a custom path, override this config.
    |
    */
    'resources_path' => 'Filament\\Resources',

    /*
    |--------------------------------------------------------------------------
    | Guard Name
    |--------------------------------------------------------------------------
    |
    | This is the guard that will be used by the package for authentication and
    | authorization. You can change this to match your application's needs.
    |
    */
    'guard_name' => 'web',
];