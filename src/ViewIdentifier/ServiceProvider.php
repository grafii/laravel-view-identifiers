<?php

namespace Hypnotract\ViewIdentifier;

/**
 * Class ServiceProvider
 * @package Hypnotract\ViewIdentifier
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Make the loading of the provider deferred.
     *
     * @var boolean
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/identifiers.php', 'identifiers');

        $this->app->singleton(ViewIdentifier::class, function ($app) {
            return new ViewIdentifier();
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../config/identifiers.php' => config_path('identifiers.php'),
            ]
        );
    }

    /**
     * Get the provided service.
     *
     * @return array
     */
    public function provides(): array
    {
        return [ViewIdentifier::class];
    }
}
