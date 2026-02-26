<?php

namespace Shahrakii\Autocrumb\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array  getBreadcrumbData(?string $locale = null)
 * @method static string generate(?string $view = null, ?string $locale = null)
 *
 * @see \Shahrakii\Autocrumb\Autocrumb
 */
class Autocrumb extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Shahrakii\Autocrumb\Autocrumb::class;
    }
}