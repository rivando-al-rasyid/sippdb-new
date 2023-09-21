<?php

namespace App\Modules\TUS;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TUServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/t_u.php');

        Blade::component('tu-app-layout', View\Components\TUAppLayout::class);
        Blade::component('tu-guest-layout', View\Components\TUGuestLayout::class);
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
        $router->aliasMiddleware('tu.auth', Http\Middleware\RedirectIfNotTU::class);
        $router->aliasMiddleware('tu.guest', Http\Middleware\RedirectIfTU::class);
        $router->aliasMiddleware('tu.verified', Http\Middleware\EnsureTUEmailIsVerified::class);
        $router->aliasMiddleware('tu.password.confirm', Http\Middleware\RequireTUPassword::class);
    }

    protected function injectAuthConfiguration()
    {
        $this->app['config']->set('auth.guards.tu', [
            'driver' => 'session',
            'provider' => 'tus',
        ]);

        $this->app['config']->set('auth.providers.tus', [
            'driver' => 'eloquent',
            'model' => Models\TU::class,
        ]);

        $this->app['config']->set('auth.passwords.tus', [
            'provider' => 'tus',
            'table' => 't_u_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ]);
    }
}
