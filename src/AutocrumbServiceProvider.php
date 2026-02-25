<?php

namespace shahrakii\Autocrumb;

use Illuminate\Support\ServiceProvider;

class AutocrumbServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__.'/../config/autocrumb.php' => config_path('autocrumb.php'),
        ], 'autocrumb-config');

        // Publish JSON translation files to project root lang/
        $this->publishes([
            __DIR__.'/../resources/lang' => $this->app->langPath(),
        ], 'autocrumb-lang');

        // Load JSON translations from package (so they work even before publishing)
        $this->loadJsonTranslationsFrom(__DIR__.'/../resources/lang');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/autocrumb.php', 'autocrumb');

        $this->app->singleton('autocrumb', fn () => new Autocrumb());
    }
}