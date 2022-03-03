<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class AdjustToPreviousWorkDayTest
 *
 * @test
 */
class AdjustToPreviousWorkDayTest extends TestCase
{
    /**
     * @test
     *
     * @param string $target
     * @param string $expected
     * @dataProvider providerPreviousWorkDay
     */
    public function it_can_get_the_previous_workday($target, $expected)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);

        $this->assertEquals(
            Carbon::parse($expected),
            Carbon::parse($target)->adjustToPreviousWorkDay()
        );
    }

    /**
     * Dataprovider for previous workday
     *
     * @return array
     */
    public function providerPreviousWorkDay()
    {
        return [
            'Monday' => [
                '2022-08-01',
                '2022-08-01',
            ],
            'Tuesday' => [
                '2022-08-02',
                '2022-08-02',
            ],
            'Wednesday' => [
                '2022-08-03',
                '2022-08-03',
            ],
            'Thurdays' => [
                '2022-08-04',
                '2022-08-04',
            ],
            'Friday' => [
                '2022-08-05',
                '2022-08-05',
            ],
            'Saturday' => [
                '2022-08-06',
                '2022-08-05',
            ],
            'Sunday' => [
                '2022-08-07',
                '2022-08-05',
            ],
            'Monday-New-Year' => [
                '2018-01-01',
                '2017-12-29',
            ],
        ];
    }

    /**
     * @test
     *
     * @param string $target
     * @param string $expectWithHoliday
     * @param string $expectedWithoutHoliday
     *
     * @dataProvider providerPreviousWorkDayHolidays
     */
    public function it_can_count_holiday_as_weekend($target, $expectWithHoliday, $expectedWithoutHoliday)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);

        $this->assertEquals(
            Carbon::parse($expectWithHoliday),
            Carbon::parse($target)->adjustToPreviousWorkDay()
        );

        $this->assertEquals(
            Carbon::parse($expectedWithoutHoliday),
            Carbon::parse($target)->adjustToPreviousWorkDay(false)
        );
    }

    /**
     * Dataprovider for previous workday
     *
     * @return array
     */
    public function providerPreviousWorkDayHolidays()
    {
        return [
            'Monday-New-Year' => [
                '2016-01-02', // 土曜日
                '2015-12-31', // 木曜日
                '2016-01-01', // 金曜日　
            ],
        ];
    }
}
