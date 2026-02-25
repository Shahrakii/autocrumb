<?php

namespace shahrakii\Autocrumb\Facades;

use Illuminate\Support\Facades\Facade;

class Autocrumb extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'autocrumb';
    }
}