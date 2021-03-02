<?php

namespace Fabpl\ModelLogin;

use Fabpl\ModelLogin\Console\PublishCommand;
use Fabpl\ModelLogin\Contracts\LoginInterface;
use Fabpl\ModelLogin\Models\Login;
use Fabpl\ModelLogin\Subscribers\LoginSubscriber;
use Illuminate\Support\ServiceProvider;

class ModelLoginServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureCommands();
        $this->configureObservers();
        $this->configurePublishing();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerMigrations();
        $this->registerSingletons();
    }

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PublishCommand::class,
            ]);
        }
    }

    /**
     * Configure the observers offered by the application.
     *
     * @return void
     */
    protected function configureObservers(): void
    {
        $this->app['events']->subscribe(LoginSubscriber::class);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing(): void
    {
        if ($this->app->runningInConsole()) {
            // Configuration...
            $this->publishes([
                __DIR__.'/../config/model-login.php' => config_path('model-login.php'),
            ], 'model-login-config');

            // Migrations...
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/'),
            ], 'model-login-migrations');
        }
    }

    /**
     * Register configuration files.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/model-login.php', 'model-login');
    }

    /**
     * Register database migrations files.
     */
    protected function registerMigrations(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register singletons into container.
     */
    protected function registerSingletons(): void
    {
        $this->app->singleton(LoginInterface::class, Login::class);
    }
}
