<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use DateTimeInterface;
use DateTimeZone;
use Generator;
use PHPUnit\Framework\TestCase;

class AlternateTimeZoneClockTest extends TestCase
{
    public function alternateTimeNowProvider(): Generator
    {
        yield [
            new DateTimeImmutable('2022-06-15T05:00 America/Chicago'),
            new DateTimeZone('America/New_York'),
            '2022-06-15T06:00:00-04:00',
        ];

        yield [
            new DateTimeImmutable('2022-06-15T05:00 America/Chicago'),
            new DateTimeZone('America/Chicago'),
            '2022-06-15T05:00:00-05:00',
        ];

        yield [
            new DateTimeImmutable('2022-06-15T12:00Z'),
            new DateTimeZone('America/New_York'),
            '2022-06-15T08:00:00-04:00',
        ];
    }

    /** @dataProvider alternateTimeNowProvider */
    public function testNow(DateTimeInterface $clockTime, DateTimeZone $timeZone, string $expectedTime): void
    {
        $alternateClock = new AlternateTimeZoneClock(new FrozenClock($clockTime), $timeZone);
        $this->assertSame($expectedTime, $alternateClock->now()->format('c'));
    }
}
