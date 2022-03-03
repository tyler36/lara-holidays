<?php

use Illuminate\Support\Carbon;
use Tyler36\LaraHolidays\Facades\LaraHolidays;

Carbon::mixin(new class {
    /**
     * Check if day is considered a holiday. Uses current locale
     *
     * @return bool
     */
    public function isHoliday() {
        return function () {
            return LaraHolidays::isHoliday($this);
        };
    }
});
