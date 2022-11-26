<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use DateTimeInterface;

class FrozenClock implements ClockInterface
{
    use TimeComparisonTrait;

    private DateTimeImmutable $now;

    public function __construct(DateTimeInterface $dateTime)
    {
        $this->now = $dateTime instanceof DateTimeImmutable
            ? $dateTime
            : DateTimeImmutable::createFromInterface($dateTime);
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }
}
