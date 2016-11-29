<?php
namespace Markup\RabbitMq;

use Illuminate\Support\ServiceProvider;

class RabbitManagerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('RabbitMq', 'Markup\RabbitMq\ApiFactory');
        if (!class_exists('RabbitMq')) {
            class_alias('Markup\RabbitMq\Facades\RabbitManager', 'RabbitMq');
        }
        $this->publishes([
            __DIR__.'/../config/rabbit-manager.php' => config_path('rabbit-manager.php'),
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['RabbitMq'];
    }
}
