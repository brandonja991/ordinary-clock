# Ordinary Clock
A simple PSR-20 Clock implementation for accessing and mocking the current time.

## Table of Contents

- [Getting Started](#getting-started)
- [Clocks](#clocks)
    - [`UTCClock`](#utcclock) - Provides UTC times. (Should be your primary clock used)
    - [`AlternateTimeZoneClock`](#alternatetimezoneclock) - Provides times in a specified timezone based on time from another clock.
    - [`FrozenClock`](#frozenclock) - Provides only the specified time. (Great for mocking and testing)
    - [`SystemClock`](#systemclock) - Provides times in the specified timezone. (Use at your own will)
- [`ClockInterface`](#clockinterface-methods)
  - [`now()`](#clockinterfacenow)
  - [`isBefore()`](#clockinterfaceisbeforedatetime)
  - [`isAfter()`](#clockinterfaceisafterdatetime)
  - [`isAtEarliest()`](#clockinterfaceisatearliestdatetime)-
  - [`isAtLatest()`](#clockinterfaceisatlatestdatetime)
  - [`isBetween()`](#clockinterfaceisbetweenstartdate-enddate)
  - [`isBetweenInclusive()`](#clockinterfaceisbetweeninclusivestartdate-enddate)
  - [`isBetweenInclusiveStart()`](#clockinterfaceisbetweeninclusivestartstartdate-enddate)

## Getting Started
```shell
composer require ordinary/clock
```

## Usage

```php
<?php

use Ordinary\Clock\ClockInterface;
use Ordinary\Clock\UTCClock;

class MyTimeAwareAction
{
    public function __construct(protected ClockInterface $clock)
    {
    }
    
    public function announceTime(): void
    {
        echo 'Time is now ' . $this->clock->now()->format('c') . PHP_EOL;
    }
}

$action = new MyTimeAwareAction(new UTCClock());
$action->announceTime();
```

## Clocks
### UTCClock
A clock that always returns date objects in UTC.  
> This should be the primary clock used when managing time.
```php
$clock = new UTCClock();
```

### AlternateTimeZoneClock
A clock that wraps another clock for use in different timezones.  
> Generally this clock should wrap a UTC clock when timezone specific operations are needed.
```php
$clock = new AlternateTimeZoneClock($primaryClock = new UTCClock(), new DateTimeZone('America/Chicago'))
```

### FrozenClock
A clock that only returns the specific time given on construct.
> Generally used for mocking time.

### SystemClock
A clock that can be constructing with a valid timezone.
```php
$clock = new \Ordinary\Clock\SystemClock(new DateTimeZone('America/Chicago'));
```

## ClockInterface Methods

### `ClockInterface::now()`
Get a `DateTimeImmutable` instance representing the current time.

### `ClockInterface::isBefore($dateTime)`
Check to see if the given time is in the future.  
***Exclusive of given time***

### `ClockInterface::isAfter($dateTime)`
Check to see if a given time is in the past.  
***Exclusive of the given time***

### `ClockInterface::isAtEarliest($dateTime)`
Check to see if at the earliest, it is the given time.  
***Inclusive version of isAfter()***

### `ClockInterface::isAtLatest($dateTime)`
Check to see if at the latest, it is the given time.  
***Inclusive version of isBefore()***

### `ClockInterface::isBetween($startDate, $endDate)`
Check to see if the current time falls in between the provided times.  
***Exclusive of provided times***

### `ClockInterface::isBetweenInclusive($startDate, $endDate)`
Check to see if the current time falls in between the provided times.  
***Inclusive of provided times***

### `ClockInterface::isBetweenInclusiveStart($startDate, $endDate)`
Check to see if the current time falls in between the provided times.  
***Inclusive ONLY of start time***  
For situations similar to the given range being 1:00, 2:00 but needing to verify the time is anything from 1:00 and 1:59.
