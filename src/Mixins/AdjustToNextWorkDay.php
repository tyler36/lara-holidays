<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /**
     * Working forwards, get the next day considered a workday, that is not a holiday
     *
     * @return Carbon
     */
    public function adjustToNextWorkDay()
    {
        /**
         * @param boolean $holidayAsWeekend     Holidays are classed as 'weekend'
         */
        return function ($holidayAsWeekend = true) {
            if ($this->isWeekend() || ($holidayAsWeekend && $this->isHoliday())) {
                return $this->addDay()->adjustToNextWorkDay($holidayAsWeekend);
            }

            return $this;
        };
    }
});

CarbonImmutable::mixin(new class {
    /**
     * Working forwards, get the next day considered a workday, that is not a holiday
     *
     * @return CarbonImmutable
     */
    public function adjustToNextWorkDay()
    {
        /**
         * @param boolean $holidayAsWeekend     Holidays are classed as 'weekend'
         */
        return function ($holidayAsWeekend = true) {
            if ($this->isWeekend() || ($holidayAsWeekend && $this->isHoliday())) {
                return $this->addDay()->adjustToNextWorkDay($holidayAsWeekend);
            }

            return $this;
        };
    }
});
