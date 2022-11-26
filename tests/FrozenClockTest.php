<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Generator;
use PHPUnit\Framework\TestCase;

class FrozenClockTest extends TestCase
{
    public function frozenClockDateProvider(): Generator
    {
        yield [new DateTimeImmutable('2022-06-15T16:59:08.503Z')];
        yield [new DateTime('2022-06-15T16:59:08.503Z')];
    }

    /** @dataProvider frozenClockDateProvider */
    public function testNow(DateTimeInterface $dateTime): void
    {
        $clock = new FrozenClock($dateTime);
        $this->assertSame(
            $dateTime->format(DateTimeInterface::RFC3339_EXTENDED),
            $clock->now()->format(DateTimeInterface::RFC3339_EXTENDED),
        );
    }
}
