<?php

namespace Tyler36\LaraHolidays\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade to for LaraHolidays
 * 
 * @method setLocale
 */
class LaraHolidays extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'lara-holidays';
    }
}
