<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface as PSRClockInterface;

class AlternateTimeZoneClock implements ClockInterface
{
    use TimeComparisonTrait;

    public function __construct(protected PSRClockInterface $primaryClock, protected DateTimeZone $timeZone)
    {
    }

    public function now(): DateTimeImmutable
    {
        return $this->primaryClock->now()->setTimezone($this->timeZone);
    }
}
