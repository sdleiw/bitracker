<?php
declare(strict_types=1);

namespace Lei\Bitracker;

use Illuminate\Support\ServiceProvider;

/**
 * Created by lei
 */
class BitrackerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'bitracker');
        // $this->loadMigrationsFrom(__DIR__ . '/../../databases/migrations');

        $this->publishes([
            __DIR__ . '/../../config/bitracker.php' => config_path('bitracker.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/bitracker'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('vendor/bitracker'),
        ], 'public');

        if ($this->app->runningInConsole()) {
            $this->commands([
                // FooCommand::class,
            ]);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
