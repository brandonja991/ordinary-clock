<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use DateTimeZone;

class SystemClock implements ClockInterface
{
    use TimeComparisonTrait;

    public function __construct(private readonly ?DateTimeZone $timeZone = null)
    {
    }

    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable(timezone: $this->timeZone);
    }
}
