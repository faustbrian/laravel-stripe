<?php

namespace BrianFaust\Stripe\Facades;

use Illuminate\Support\Facades\Facade;

class Stripe extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stripe';
    }
}
