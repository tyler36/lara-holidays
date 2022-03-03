<?php

namespace Tyler36\LaraHolidays;

use Yasumi\Yasumi;
use Carbon\CarbonImmutable;
use Yasumi\Filters\OnFilter;

class LaraHolidays
{
    protected $locale;
    protected $year;
    protected $provider;

    /**
     * LaraHolidays constructor
     *
     */
    public function __construct()
    {
        $this->locale = config()->get('lara-holidays.region', 'Japan');
    }

    /**
     * Get the locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the locale
     *
     * @param string $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Get the target year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the target year
     *
     * @param string $year
     * @return void
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * Get the holiday provider
     *
     * @param string $year
     * @return Yasumi
     */
    public function getProvider($year = null)
    {
        if (!$this->provider) {
            $this->setProvider($year);
        }

        return $this->provider;
    }

    /**
     * Set the provider instance
     *
     * @param string $year
     * @return void
     */
    public function setProvider($year)
    {
        $this->provider = Yasumi::create(self::getLocale(), $year);
    }


    /**
     * Get a list of holidays for the target year
     *
     * @param string $year
     * @return void
     */
    public function getHolidays($year)
    {
        $provider = $this->getProvider($year);

        return collect($provider);
    }

    /**
     * Convert the date to a CarbonImmuntable object
     *
     * @param string $date
     * @return CarbonImmuntable
     */
    private static function toCarbonImmutable($date) {
        return CarbonImmutable::parse($date);
    }

    /**
     * Check if a $target date is a holiday
     *
     * @param string $target
     * @return bool
     */
    public function isHoliday($target)
    {
        if (getType($target->format('Y')) === 'string') {
            $target = self::toCarbonImmutable($target);
        }

        $provider = $this->getProvider($target->format('Y'));

        return in_array($target->format('Y-m-d'), $provider->getHolidayDates());
    }
}
