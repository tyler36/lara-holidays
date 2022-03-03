<?php


namespace Tests\Unit;

use Carbon\Carbon;
use Tyler36\LaraHolidays\Tests\TestCase;
use Tyler36\LaraHolidays\Facades\LaraHolidays;

/**
 * Class IsHolidayTest
 *
 * @test
 */
class IsHolidayTest extends TestCase
{
    /**
     * @test
     * @dataProvider providerJapanHolidays
     */
    public function it_can_check_if_a_date_is_a_holiday($target, $expected)
    {
        $this->assertEquals($expected, Carbon::parse($target)->isHoliday());
    }

    /**
     * @test
     * @dataProvider providerUsaHolidays
     */
    public function it_can_check_if_a_date_is_a_USA_holiday($target, $expected)
    {
        LaraHolidays::setLocale('USA');
        $this->assertEquals($expected, Carbon::parse($target)->isHoliday());
    }

    /**
     * Dataprovider for a range of Japanese holidays
     *
     * @return array
     */
    public function providerJapanHolidays()
    {
        return [
            '2022-元日' => [
                '2022-01-01',
                true,
            ],
            '2022-成人の日' => [
                '2022-01-10',
                true,
            ],
            '2022-建国記念の日' => [
                '2022-02-11',
                true,
            ],
            '2022-天皇誕生日' => [
                '2022-02-23',
                true,
            ],
            '2022-春分の日' => [
                '2022-03-21',
                true,
            ],
            '2022-昭和の日' => [
                '2022-04-29',
                true,
            ],
            '2022-憲法記念日' => [
                '2022-05-03',
                true,
            ],
            '2022-みどりの日' => [
                '2022-05-04',
                true,
            ],
            '2022-こどもの日' => [
                '2022-05-05',
                true,
            ],
            '2022-海の日' => [
                '2022-07-18',
                true,
            ],
            '2022-山の日' => [
                '2022-08-11',
                true,
            ],
            '2022-敬老の日' => [
                '2022-09-19',
                true,
            ],
            '2022-秋分の日' => [
                '2022-09-23',
                true,
            ],
            '2022-スポーツの日' => [
                '2022-10-10',
                true,
            ],
            '2022-文化の日' => [
                '2022-11-03',
                true,
            ],
            '2022-勤労感謝の日' => [
                '2022-11-23',
                true,
            ],
            '2022-Christmas' => [
                '2022-12-25',
                false,
            ],
        ];
    }


    /**
     * Dataprovider for USA holidays
     *
     * @return array
     */
    public function providerUSAHolidays()
    {
        return [
            '2022-new-year' => [
                '2022-01-01',
                true,
            ],
            '2022-憲法記念日' => [
                '2022-05-03',
                false,
            ],
            '2022-みどりの日' => [
                '2022-05-04',
                false,
            ],
            '2022-こどもの日' => [
                '2022-05-05',
                false,
            ],
            '2022-Christmas' => [
                '2022-12-25',
                true,
            ],
        ];
    }
}
