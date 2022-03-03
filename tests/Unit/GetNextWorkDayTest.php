<?php


namespace Tests\Unit;

use Carbon\Carbon;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class GetNextWorkDayTest
 *
 * @test
 */
class GetNextWorkDayTest extends TestCase
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
            Carbon::parse($target)->getNextWorkDay()
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
                '2022-08-02',
            ],
            'Tuesday' => [
                '2022-08-02',
                '2022-08-03',
            ],
            'Wednesday' => [
                '2022-08-03',
                '2022-08-04',
            ],
            'Thurdays' => [
                '2022-08-04',
                '2022-08-05',
            ],
            'Friday' => [
                '2022-08-05',
                '2022-08-08',
            ],
            'Saturday' => [
                '2022-08-06',
                '2022-08-08',
            ],
            'Sunday' => [
                '2022-08-07',
                '2022-08-08',
            ],
            'next month' => [
                '2022-07-31',
                '2022-08-01',
            ],
            'next year' => [
                '2021-12-31',
                '2022-01-03',
            ],
        ];
    }
}
