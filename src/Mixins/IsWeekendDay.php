<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /** @var String */
    public $dayOfWeekIso;

    /**
     * Check if day is considered a weeknd, as defined by config
     *
     * @return bool
     */
    public function isWeekendDay()
    {
        return function () {
            $weekenddays = config()->get('lara-holidays.weekenddays');

            return in_array($this->dayOfWeekIso, $weekenddays);
        };
    }
});

CarbonImmutable::mixin(new class {
    /** @var String */
    public $dayOfWeekIso;

    /**
     * Check if day is considered a weeknd, as defined by config
     *
     * @return bool
     */
    public function isWeekendDay()
    {
        return function () {
            $weekenddays = config()->get('lara-holidays.weekenddays');

            return in_array($this->dayOfWeekIso, $weekenddays);
        };
    }
});
