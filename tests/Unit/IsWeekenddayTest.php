<?php


namespace Tests\Unit;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Tyler36\LaraHolidays\Tests\TestCase;

/**
 * Class IsWeekenddayTest
 *
 * @test
 */
class IsWeekenddayTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerStandardWeekendDay
     */
    public function it_can_check_if_a_date_is_a_weekendday($target, $expected)
    {
        config()->set('lara-holidays.weekenddays', [6,7]);
        $this->assertEquals($expected, Carbon::parse($target)->isWeekendDay());
    }

    /**
     * @test
     * @group immutable
     * @dataProvider providerStandardWeekendDay
     */
    public function it_can_check_if_a_date_is_a_weekendday_immutable($target, $expected)
    {
        config()->set('lara-holidays.weekenddays', [6,7]);
        $this->assertEquals($expected, CarbonImmutable::parse($target)->isWeekendDay());
    }

    /** @test */
    public function it_can_use_the_config_settings()
    {
        config()->set('lara-holidays.weekenddays', [6,3,4,5]);

        $this->assertFalse(Carbon::parse('2022-08-01')->isWeekendDay()); // Monday (1)
        $this->assertFalse(Carbon::parse('2022-08-02')->isWeekendDay()); // Tuesday (2)
        $this->assertTrue(Carbon::parse('2022-08-03')->isWeekendDay()); // Wednesday (3)
        $this->assertTrue(Carbon::parse('2022-08-04')->isWeekendDay()); // Thursday (4)
        $this->assertTrue(Carbon::parse('2022-08-05')->isWeekendDay()); // Friday (5)
        $this->assertTrue(Carbon::parse('2022-08-06')->isWeekendDay()); // Saturday (6)
        $this->assertFalse(Carbon::parse('2022-08-07')->isWeekendDay()); // Sunday (7)
    }

    /**
     * Dataprovider for standard weekend
     *
     * @return array
     */
    public function providerStandardWeekendDay()
    {
        return [
            'Monday' => [
                '2022-08-01',
                false,
            ],
            'Tuesday' => [
                '2022-08-02',
                false,
            ],
            'Wednesday' => [
                '2022-08-03',
                false,
            ],
            'Thurdays' => [
                '2022-08-04',
                false,
            ],
            'Friday' => [
                '2022-08-05',
                false,
            ],
            'Saturday' => [
                '2022-08-06',
                true,
            ],
            'Sunday' => [
                '2022-08-07',
                true,
            ],
        ];
    }
}
