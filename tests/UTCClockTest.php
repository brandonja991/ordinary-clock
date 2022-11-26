<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeZone;
use PHPUnit\Framework\TestCase;

class UTCClockTest extends TestCase
{
    public function testTimeZone(): void
    {
        $clock = new UTCClock();
        $this->assertSame(
            (new DateTimeZone('UTC'))->getName(),
            $clock->now()->getTimezone()->getName(),
        );
    }
}
