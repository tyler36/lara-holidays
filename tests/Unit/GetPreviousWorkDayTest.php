<?php


namespace Tests\Unit;

use Carbon\Carbon;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class GetPreviousWorkDayTest
 *
 * @test
 */
class GetPreviousWorkDayTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerPreviousWorkDay
     */
    public function it_can_get_the_previous_workday($target, $expected)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);

        $this->assertEquals(
            Carbon::parse($expected),
            Carbon::parse($target)->getPreviousWorkDay()
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
                '2022-07-29',
            ],
            'Tuesday' => [
                '2022-08-02',
                '2022-08-01',
            ],
            'Wednesday' => [
                '2022-08-03',
                '2022-08-02',
            ],
            'Thurdays' => [
                '2022-08-04',
                '2022-08-03',
            ],
            'Friday' => [
                '2022-08-05',
                '2022-08-04',
            ],
            'Saturday' => [
                '2022-08-06',
                '2022-08-05',
            ],
            'Sunday' => [
                '2022-08-07',
                '2022-08-05',
            ],
        ];
    }
}
