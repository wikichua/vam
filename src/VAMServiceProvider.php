<?php

namespace Wikichua\VAM;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class VAMServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'vam');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'vam');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/web.php');

        $this->app['router']->aliasMiddleware('https_protocol', 'Wikichua\VAM\Middleware\HttpsProtocol');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadRoutes();
        $this->gatePermissions();
        $this->validatorExtensions();
        $this->configSettings();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/vam.php', 'vam');

        // Register the service the package provides.
        $this->app->singleton('vam', function ($app) {
            return new VAM;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['vam'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/vam.php' => config_path('vam.php'),
        ], 'vam.config');

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/vam'),
        ], 'vam.view');

        // Publishing the resources.
        $this->publishes([
            __DIR__ . '/../resources/js' => base_path('resources/js'),
            __DIR__ . '/../resources/sass' => base_path('resources/sass'),
            __DIR__ . '/../package.json' => base_path('package.json'),
            __DIR__ . '/../webpack.mix.js' => base_path('webpack.mix.js'),
        ], 'vam.install');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/vam'),
        ], 'vam.views');*/

        // Registering package commands.
        $this->commands([
            Commands\VamConfig::class,
            Commands\VamMake::class,
        ]);
    }

    protected function loadRoutes()
    {
        foreach (File::files(__DIR__ . '/routers/') as $file) {
            Route::middleware('web')
                // ->namespace(config('vam.controller_namespace'))
                ->group($file->getPathname());
        }
        if (File::exists(app_path('../routes/routers'))) {
            foreach (File::files(app_path('../routes/routers/')) as $file) {
                Route::middleware('web')
                    ->group($file->getPathname());
            }
        }
    }

    protected function gatePermissions()
    {
        Gate::before(function ($user, $permission) {
            if ($user->hasPermission($permission)) {
                return true;
            }
        });
    }
    protected function validatorExtensions()
    {
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        }, 'The current password is invalid.');
    }
    protected function configSettings()
    {
        if (Schema::hasTable('settings')) {
            foreach (app(config('vam.models.setting'))->all() as $setting) {
                Config::set('settings.' . $setting->key, $setting->value);
            }
        }
    }
}
