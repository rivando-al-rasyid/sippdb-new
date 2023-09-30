<?php

namespace App\Modules\Tus;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/tu.php');

        Blade::component('tu-app-layout', View\Components\TuAppLayout::class);
        Blade::component('tu-guest-layout', View\Components\TuGuestLayout::class);
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
        $router->aliasMiddleware('tu.auth', Http\Middleware\RedirectIfNotTu::class);
        $router->aliasMiddleware('tu.guest', Http\Middleware\RedirectIfTu::class);
        $router->aliasMiddleware('tu.verified', Http\Middleware\EnsureTuEmailIsVerified::class);
        $router->aliasMiddleware('tu.password.confirm', Http\Middleware\RequireTuPassword::class);
    }

    protected function injectAuthConfiguration()
    {
        $this->app['config']->set('auth.guards.tu', [
            'driver' => 'session',
            'provider' => 'tus',
        ]);

        $this->app['config']->set('auth.providers.tus', [
            'driver' => 'eloquent',
            'model' => Models\Tu::class,
        ]);

        $this->app['config']->set('auth.passwords.tus', [
            'provider' => 'tus',
            'table' => 'tu_password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ]);
    }
}
