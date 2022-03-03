<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /**
     * Working backwards, get the first previous day considered a workday, that is not a holiday
     *
     * @return Carbon
     */
    public function adjustToPreviousWorkDay()
    {
        return function ($holidayAsWeekend = true) {
            if ($this->isWeekend() || ($holidayAsWeekend && $this->isHoliday() ) ) {
                $this->subDay()->adjustToPreviousWorkDay($holidayAsWeekend);
            }

            return $this;
        };
    }
});

CarbonImmutable::mixin(new class {
    /**
     * Working backwards, get the first previous day considered a workday, that is not a holiday
     *
     * @return CarbonImmutable
     */
    public function adjustToPreviousWorkDay()
    {
        /**
         * @param boolean $holidayAsWeekend     Holidays are classed as 'weekend'
         */
        return function ($holidayAsWeekend = true ) {
            if ($this->isWeekend() || ($holidayAsWeekend && $this->isHoliday() ) ) {
                $this->subDay()->adjustToPreviousWorkDay($holidayAsWeekend);
            }

            return $this;
        };
    }
});
