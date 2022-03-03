<?php

use Carbon\CarbonImmutable;
use Illuminate\Support\Carbon;

Carbon::mixin(new class {
    /**
     * Working backwards, get the first previous day considered a workday
     *
     * @return Carbon
     */
    public function getPreviousWorkDay()
    {
        return function () {
            $date = $this->subDay();

            return $date->isWorkDay()
                ? $date
                : $date->getPreviousWorkDay();
        };
    }
});

CarbonImmutable::mixin(new class {
    /**
     * Working backwards, get the first previous day considered a workday
     *
     * @return CarbonImmutable
     */
    public function getPreviousWorkDay()
    {
        return function () {
            $previous = CarbonImmutable::parse($this)->subDay();

            return $previous->isWorkDay()
                ? $previous
                : $previous->getPreviousWorkDay();
        };
    }
});
