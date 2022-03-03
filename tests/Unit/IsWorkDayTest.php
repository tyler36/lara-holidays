<?php


namespace Tests\Unit;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class IsWorkDayTest
 *
 * @test
 */
class IsWorkDayTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerStandardWorkDay
     */
    public function it_can_check_if_a_date_is_a_workday($target, $expected)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);
        $this->assertEquals($expected, Carbon::parse($target)->isWorkDay()); // Monday (1)
    }

    /**
     * @test
     * @group immutable
     * @dataProvider providerStandardWorkDay
     */
    public function it_can_check_if_a_date_is_a_workday_immutable($target, $expected)
    {
        config()->set('lara-holidays.workdays', [1,2,3,4,5]);
        $this->assertEquals($expected, CarbonImmutable::parse($target)->isWorkDay()); // Monday (1)

}

    /** @test */
    public function it_can_use_the_config_settings()
    {
        config()->set('lara-holidays.workdays', [6,3,4,5]);

        $this->assertFalse(Carbon::parse('2022-08-01')->isWorkDay()); // Monday (1)
        $this->assertFalse(Carbon::parse('2022-08-02')->isWorkDay()); // Tuesday (2)
        $this->assertTrue(Carbon::parse('2022-08-03')->isWorkDay()); // Wednesday (3)
        $this->assertTrue(Carbon::parse('2022-08-04')->isWorkDay()); // Thursday (4)
        $this->assertTrue(Carbon::parse('2022-08-05')->isWorkDay()); // Friday (5)
        $this->assertTrue(Carbon::parse('2022-08-06')->isWorkDay()); // Saturday (6)
        $this->assertFalse(Carbon::parse('2022-08-07')->isWorkDay()); // Sunday (7)
    }

    /**
     * Dataprovider for standard work work
     *
     * @return array
     */
    public function providerStandardWorkDay()
    {
        return [
            'Monday' => [
                '2022-08-01',
                true,
            ],
            'Tuesday' => [
                '2022-08-02',
                true,
            ],
            'Wednesday' => [
                '2022-08-03',
                true,
            ],
            'Thurdays' => [
                '2022-08-04',
                true,
            ],
            'Friday' => [
                '2022-08-05',
                true,
            ],
            'Saturday' => [
                '2022-08-06',
                false,
            ],
            'Sunday' => [
                '2022-08-07',
                false,
            ],
        ];
    }
}
