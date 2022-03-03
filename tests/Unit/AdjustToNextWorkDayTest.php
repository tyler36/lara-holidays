<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class AdjustToNextWorkDayTest
 *
 * @test
 */
class AdjustToNextWorkDayTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerNextWorkDay
     */
    public function it_can_get_the_next_workday($target, $expected)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);

        $this->assertEquals(
            Carbon::parse($expected),
            Carbon::parse($target)->adjustToNextWorkDay()
        );
    }

    /**
     * Dataprovider for next workday
     *
     * @return array
     */
    public function providerNextWorkDay()
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
                '2022-08-08',
            ],
            'Sunday' => [
                '2022-08-07',
                '2022-08-08',
            ],
            'Friday-New-Year' => [
                '2021-01-01',
                '2021-01-04',
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
     * @dataProvider providerNextWorkDayHolidays
     */
    public function it_can_count_holiday_as_weekend($target, $expectWithHoliday, $expectedWithoutHoliday)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);

        $this->assertEquals(
            Carbon::parse($expectWithHoliday),
            Carbon::parse($target)->adjustToNextWorkDay()
        );

        $this->assertEquals(
            Carbon::parse($expectedWithoutHoliday),
            Carbon::parse($target)->adjustToNextWorkDay(false)
        );
    }

    /**
     * Dataprovider for next workday
     *
     * @return array
     */
    public function providerNextWorkDayHolidays()
    {
        return [
            'Monday-New-Year' => [
                '2017-12-31', // 月曜日
                '2018-01-02', // 木曜日
                '2018-01-01', // 月曜日
            ],
        ];
    }
}
