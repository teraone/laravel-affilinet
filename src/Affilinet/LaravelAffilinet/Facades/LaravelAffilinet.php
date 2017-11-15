<?php

namespace Affilinet\LaravelAffilinet\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelAffilinet extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'affilinet';
    }
}