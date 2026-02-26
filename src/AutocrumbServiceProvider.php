<?php

namespace Shahrakii\Autocrumb;

use Illuminate\Support\ServiceProvider;

class AutocrumbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Merge default config
        $this->mergeConfigFrom(
            __DIR__ . '/../config/autocrumb.php',
            'autocrumb'
        );

        $this->app->singleton(Autocrumb::class, function ($app) {
            return new Autocrumb(
                $app->make(\Illuminate\Http\Request::class), // ← resolves at runtime
                $app['config']['autocrumb']
            );
        });
    }

    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../config/autocrumb.php' => config_path('autocrumb.php'),
        ], 'autocrumb-config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/autocrumb'),
        ], 'autocrumb-views');

        // Publish lang files
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/autocrumb'),
        ], 'autocrumb-lang');

        // Load views from package
        $this->loadViewsFrom(
            __DIR__ . '/../resources/views',
            'autocrumb'
        );
    }
}