<?php

namespace Shahrakii\Autocrumb\Facades;

use Illuminate\Support\Facades\Facade;

class Autocrumb extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'autocrumb';
    }
}