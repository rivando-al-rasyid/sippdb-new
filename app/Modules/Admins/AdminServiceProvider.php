<?php

namespace App\Modules\Admins;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/admin.php');

        Blade::component('admin-app-layout', View\Components\AdminAppLayout::class);
        Blade::component('admin-guest-layout', View\Components\AdminGuestLayout::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->registerMiddleware();
        $this->injectAuthConfiguration();
    }

    /**
     * @see https://laracasts.com/discuss/channels/general-discussion/register-middleware-via-service-provider
     */
    protected function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('admin.auth', Http\Middleware\RedirectIfNotAdmin::class);
        $router->aliasMiddleware('admin.guest', Http\Middleware\RedirectIfAdmin::class);
        $router->aliasMiddleware('admin.verified', Http\Middleware\EnsureAdminEmailIsVerified::class);
        $router->aliasMiddleware('admin.password.confirm', Http\Middleware\RequireAdminPassword::class);
    }

    protected function injectAuthConfiguration()
    {
        $this->app['config']->set('auth.guards.admin', [
            'driver' => 'session',
            'provider' => 'admins',
        ]);

        $this->app['config']->set('auth.providers.admins', [
            'driver' => 'eloquent',
            'model' => Models\Admin::class,
        ]);

        $this->app['config']->set('auth.passwords.admins', [
            'provider' => 'admins',
            'table' => 'admin_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ]);
    }
}
