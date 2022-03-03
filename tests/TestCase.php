<?php

namespace Tyler36\LaraHolidays\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Tyler36\LaraHolidays\LaraHolidaysServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaraHolidaysServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
