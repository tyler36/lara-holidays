# LaraHolidays <!-- omit in toc -->

- [Installation](#installation)
- [Usage](#usage)
  - [IsWorkDay](#isworkday)
  - [IsWeekendDay](#isweekendday)
  - [IsHolidayDay](#isholidayday)
  - [GetPreviousWorkDay](#getpreviousworkday)
  - [GetNextWorkDay](#getnextworkday)
  - [AdjustToPreviousWorkDayTest](#adjusttopreviousworkdaytest)
  - [AdjustToNextWorkDayTest](#adjusttonextworkdaytest)
- [Testing](#testing)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

This package is a helper package to work with workdays, weekends and holidays.
It uses:

- [Carbon](https://carbon.nesbot.com/) to work with dates
- [Yasumi](https://www.yasumi.dev/docs/cookbook/basic/) for holidays

## Installation

Via Composer

``` bash
composer require tyler36/lara-holidays
```

## Usage

This package extends Carbon to provide several useful features.

### IsWorkDay

- This checks to see if the day is considered a 'work day'. Default is Monday => Friday

```php
Carbon::parse('2022-08-01')->isWorkDay()
// -> True (Monday)

Carbon::parse('2022-08-06')->isWorkDay()
// -> False (Saturaday)
```

### IsWeekendDay

- This checks to see if the day is considered a 'weekend day'. Default is Saturday, Sunday

```php
Carbon::parse('2022-08-01')->isWorkDay()
// -> False (Monday)

Carbon::parse('2022-08-06')->isWorkDay()
// -> True (Saturaday)
```

### IsHolidayDay

- This checks if the day is considered a holiday.
- Holidays are determined by the [Yasumi](https://www.yasumi.dev/docs/cookbook/basic/) package.
- Holidays are determined by locale which can be set in the config file. Default is 'Japan'

```php
Carbon::parse('2022-01-01')->isHoliday()
// -> True

Carbon::parse('2022-12-25')->isHoliday()
// -> False (Default local is Japan)

LaraHolidays::setLocale('USA');
Carbon::parse('2022-12-25')->isHoliday()
// -> True
```

### GetPreviousWorkDay

- This returns a date that is the first previous workday.

```php
// Given '2022-08-06' (Saturaday)
Carbon::parse('2022-08-06')->getPreviousWorkDay()
// 2022-08-05 (Friday)
```

### GetNextWorkDay

- This returns a date that is the next workday.

```php
// Given 2022-08-05 (Friday)
Carbon::parse('2022-08-05')->getPreviousWorkDay()
// '2022-08-08' (Monday)
```

### AdjustToPreviousWorkDayTest

- Similar to "GetPreviousWorkDay", but also skips holidays. IE. Previous workday, not a weekend or holiday.

### AdjustToNextWorkDayTest

- Similar to "GetNextWorkDay", but also skips holidays. IE. Next workday, not a weekend or holiday.

## Testing

``` bash
phpunit
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author@email.com instead of using the issue tracker.

## Credits

- [Tyler36]

## License

MIT. Please see the [license file](license.md) for more information.
