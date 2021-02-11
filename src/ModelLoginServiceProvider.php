<?php

namespace Fabpl\ModelLogin;

use Fabpl\ModelLogin\Console\InstallCommand;
use Fabpl\ModelLogin\Console\PublishCommand;
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
                InstallCommand::class,
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
                __DIR__ . '/../config/model-login.php' => config_path('model-login.php'),
            ], 'model-login-config');

            // Migrations...
            $this->publishes([
                __DIR__ . '/../database/migrations/2021_01_01_000000_create_logins_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_logins_table.php'),
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
        $this->mergeConfigFrom(__DIR__ . '/../config/model-login.php', 'model-login');
    }
}
