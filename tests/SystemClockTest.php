<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeZone;
use PHPUnit\Framework\TestCase;

class SystemClockTest extends TestCase
{
    /** @return array{DateTimeZone}[] */
    public function timeZoneProvider(): array
    {
        return array_map(static fn (string $id): array => [new DateTimeZone($id)], DateTimeZone::listIdentifiers());
    }

    /** @dataProvider timeZoneProvider */
    public function testSystemTimeZone(DateTimeZone $timezone): void
    {
        $clock = new SystemClock($timezone);
        $this->assertSame($timezone->getName(), $clock->now()->getTimezone()->getName());
    }
}
