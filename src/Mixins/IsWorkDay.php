<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /** @var String */
    public $dayOfWeekIso;

    /**
     * Check if day is considered a working day, as defined by config file
     *
     * @return bool
     */
    public function isWorkDay() {
        return function () {
            $worksdays = config()->get('lara-holidays.workdays');

            return in_array($this->dayOfWeekIso, $worksdays);
        };
    }
});

CarbonImmutable::mixin(new class {
    /** @var String */
    public $dayOfWeekIso;

    /**
     * Check if day is considered a working day, as defined by config file
     *
     * @return bool
     */
    public function isWorkDay() {
        return function () {
            $worksdays = config()->get('lara-holidays.workdays');

            return in_array($this->dayOfWeekIso, $worksdays);
        };
    }
});
