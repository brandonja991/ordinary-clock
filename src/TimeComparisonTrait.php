<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use DateTimeInterface;

trait TimeComparisonTrait
{
    abstract public function now(): DateTimeImmutable;

    public function isBefore(DateTimeInterface $dateTime): bool
    {
        return $this->now() < $dateTime;
    }

    public function isAfter(DateTimeInterface $dateTime): bool
    {
        return $this->now() > $dateTime;
    }

    public function isAtEarliest(DateTimeInterface $dateTime): bool
    {
        return $this->now() >= $dateTime;
    }

    public function isAtLatest(DateTimeInterface $dateTime): bool
    {
        return $this->now() <= $dateTime;
    }

    public function isBetween(DateTimeInterface $start, DateTimeInterface $end): bool
    {
        return ($now = $this->now()) > $start && $now < $end;
    }

    public function isBetweenInclusive(DateTimeInterface $start, DateTimeInterface $end): bool
    {
        return ($now = $this->now()) >= $start && $now <= $end;
    }

    public function isBetweenInclusiveStart(DateTimeInterface $start, DateTimeInterface $end): bool
    {
        return ($now = $this->now()) >= $start && $now < $end;
    }
}
