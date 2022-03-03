<?php

namespace Tyler36\LaraHolidays;

use Illuminate\Support\ServiceProvider;

class LaraHolidaysServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'tyler36');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'tyler36');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lara-holidays.php', 'lara-holidays');

        // Register the service the package provides.
        $this->app->singleton('lara-holidays', function ($app) {
            return new LaraHolidays;
        });

        $this->loadCarbonMixins();
    }


    /**
     * Load available CarbonMixins
     *
     * @return void
     */
    public function loadCarbonMixins()
    {
        foreach (glob(__DIR__ . '/Mixins/*.php') as $filename)
        {
            include $filename;
        }

    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['lara-holidays'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/lara-holidays.php' => config_path('lara-holidays.php'),
        ], 'lara-holidays.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/tyler36'),
        ], 'lara-holidays.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/tyler36'),
        ], 'lara-holidays.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/tyler36'),
        ], 'lara-holidays.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
