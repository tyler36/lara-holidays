<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /**
     * Get the earliest workday
     *
     * @return Carbon
     */
    public function getNextWorkDay() {
        return function () {
            $next = $this->addDay(1);

            return $next->isWorkDay()
                ? $next
                : $next->getNextWorkDay();
        };
    }
});

CarbonImmutable::mixin(new class {
    public function getNextWorkDay() {
        return function () {
            $next = CarbonImmutable::parse($this)->addDay(1);

            return $next->isWorkDay()
                ? $next
                : $next->getNextWorkDay();
        };
    }
});
