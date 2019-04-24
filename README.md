# Laravel-Module-Admin

This module supports backend for Angular-Module-Admin

**Required packages**
*--no required packages--*

**Required Modules**
1. Laravel-Module-Core

**Functionalities**
1. Manage roles
2. Manage permissions
3. Manage users
4. Manage categories
5. Manage languages
6. Manage menus

**Installation**
1. Add the module to Laravel project as a submodule. 
`git submodule add https://github.com/bwqr/Laravel-Module-Admin app/Modules/Admin`
2. Add the route file `Http/admin.php` to `app/Providers/RouteServiceProvider.php`
 and register inside the `map` function, eg.  
 `
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('api')
            ->namespace($this->moduleNamespace . "\Admin\Http\Controllers")
            ->group(base_path('app/Modules/Admin/Http/admin.php'));
    }
 `
3. Add the middlewares from `Http/Middleware` to `app/Http/Kernel.php` file. eg,
`
[
'admin' => \App\Modules\Admin\Http\Middleware\Admin::class
]
`
