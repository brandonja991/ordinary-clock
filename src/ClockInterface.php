<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeInterface;
use Psr\Clock\ClockInterface as PSRClockInterface;

interface ClockInterface extends PSRClockInterface
{
    /**
     * Check to see if the given time is in the future.
     * **Exclusive of given time**
     */
    public function isBefore(DateTimeInterface $dateTime): bool;

    /**
     * Check to see if a given time is in the past.
     * **Exclusive of the given time**
     */
    public function isAfter(DateTimeInterface $dateTime): bool;

    /**
     * Check to see if at the earliest, it is the given time.
     * **Inclusive version of isAfter()**
     */
    public function isAtEarliest(DateTimeInterface $dateTime): bool;

    /**
     * Check to see if at the latest, it is the given time.
     * **Inclusive version of isBefore()**
     */
    public function isAtLatest(DateTimeInterface $dateTime): bool;

    /**
     * Check to see if the current time falls in between the provided times.
     * **Exclusive of provided times**
     */
    public function isBetween(DateTimeInterface $start, DateTimeInterface $end): bool;

    /**
     * Check to see if the current time falls in between the provided times.
     * **Inclusive of provided times**
     */
    public function isBetweenInclusive(DateTimeInterface $start, DateTimeInterface $end): bool;

    /**
     * Check to see if the current time falls in between the provided times.
     * **Inclusive ONLY of start time**
     * For situations similar to the given range being 1:00, 2:00 but needing to verify the time is anything from
     * 1:00 and 1:59.
     */
    public function isBetweenInclusiveStart(DateTimeInterface $start, DateTimeInterface $end): bool;
}
