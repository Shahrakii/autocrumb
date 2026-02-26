<?php

namespace Shahrakii\Autocrumb;

use Illuminate\Support\ServiceProvider;

class AutocrumbServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/autocrumb.php', 'autocrumb');

        $this->app->singleton('autocrumb', fn () => new Autocrumb());
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/autocrumb.php' => config_path('autocrumb.php'),
        ], 'autocrumb-config');

        $this->publishes([
            __DIR__.'/../resources/lang' => $this->app->langPath(),
        ], 'autocrumb-lang');

        $this->publishes([
            __DIR__.'/../resources/views/breadcrumbs.blade.php' => resource_path('views/breadcrumbs.blade.php'),
        ], 'autocrumb-views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'autocrumb');
    }
}