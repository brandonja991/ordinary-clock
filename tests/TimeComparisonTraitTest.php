<?php

declare(strict_types=1);

namespace Ordinary\Clock;

use DateTimeImmutable;
use Generator;
use PHPUnit\Framework\TestCase;

class TimeComparisonTraitTest extends TestCase
{
    public function isBeforeProvider(): Generator
    {
        yield ['2022-06-15', '2022-06-16', true];
        yield ['2022-06-16', '2022-06-15', false];
        yield ['2022-06-15', '2022-06-15', false];
    }

    /** @dataProvider isBeforeProvider */
    public function testIsBefore(string $clockTime, string $subjectTime, bool $expected): void
    {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $subject = new DateTimeImmutable($subjectTime);
        self::assertSame($expected, $clock->isBefore($subject));
    }

    public function isAfterProvider(): Generator
    {
        yield ['2022-06-15', '2022-06-16', false];
        yield ['2022-06-16', '2022-06-15', true];
        yield ['2022-06-15', '2022-06-15', false];
    }

    /** @dataProvider isAfterProvider */
    public function testIsAfter(string $clockTime, string $subjectTime, bool $expected): void
    {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $subject = new DateTimeImmutable($subjectTime);
        self::assertSame($expected, $clock->isAfter($subject));
    }

    public function isAtEarliestProvider(): Generator
    {
        yield ['2022-06-15', '2022-06-16', false];
        yield ['2022-06-16', '2022-06-15', true];
        yield ['2022-06-15', '2022-06-15', true];
    }

    /** @dataProvider isAtEarliestProvider */
    public function testIsAtEarliest(string $clockTime, string $subjectTime, bool $expected): void
    {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $subject = new DateTimeImmutable($subjectTime);
        self::assertSame($expected, $clock->isAtEarliest($subject));
    }

    public function isAtLatestProvider(): Generator
    {
        yield ['2022-06-15', '2022-06-16', true];
        yield ['2022-06-16', '2022-06-15', false];
        yield ['2022-06-15', '2022-06-15', true];
    }

    /** @dataProvider isAtLatestProvider */
    public function testIsAtLatest(string $clockTime, string $subjectTime, bool $expected): void
    {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $subject = new DateTimeImmutable($subjectTime);
        self::assertSame($expected, $clock->isAtLatest($subject));
    }

    public function isBetweenProvider(): Generator
    {
        yield ['2022-06-16', '2022-06-15', '2022-06-17', true];
        yield ['2022-06-14', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-18', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-15', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-17', '2022-06-15', '2022-06-17', false];
    }

    /** @dataProvider isBetweenProvider */
    public function testIsBetween(string $clockTime, string $subjectStart, string $subjectEnd, bool $expected): void
    {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $start = new DateTimeImmutable($subjectStart);
        $end = new DateTimeImmutable($subjectEnd);
        self::assertSame($expected, $clock->isBetween($start, $end));
    }

    public function isBetweenInclusiveProvider(): Generator
    {
        yield ['2022-06-16', '2022-06-15', '2022-06-17', true];
        yield ['2022-06-14', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-18', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-15', '2022-06-15', '2022-06-17', true];
        yield ['2022-06-17', '2022-06-15', '2022-06-17', true];
    }

    /** @dataProvider isBetweenInclusiveProvider */
    public function testIsBetweenInclusive(
        string $clockTime,
        string $subjectStart,
        string $subjectEnd,
        bool $expected,
    ): void {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $start = new DateTimeImmutable($subjectStart);
        $end = new DateTimeImmutable($subjectEnd);
        self::assertSame($expected, $clock->isBetweenInclusive($start, $end));
    }

    public function isBetweenInclusiveStartProvider(): Generator
    {
        yield ['2022-06-16', '2022-06-15', '2022-06-17', true];
        yield ['2022-06-14', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-18', '2022-06-15', '2022-06-17', false];
        yield ['2022-06-15', '2022-06-15', '2022-06-17', true];
        yield ['2022-06-17', '2022-06-15', '2022-06-17', false];
    }

    /** @dataProvider isBetweenInclusiveStartProvider */
    public function testIsBetweenInclusiveStart(
        string $clockTime,
        string $subjectStart,
        string $subjectEnd,
        bool $expected,
    ): void {
        $clock = $this->createClock(new DateTimeImmutable($clockTime));
        $start = new DateTimeImmutable($subjectStart);
        $end = new DateTimeImmutable($subjectEnd);
        self::assertSame($expected, $clock->isBetweenInclusiveStart($start, $end));
    }

    private function createClock(DateTimeImmutable $dateTime): ClockInterface
    {
        return new class ($dateTime) implements ClockInterface {
            use TimeComparisonTrait;

            public function __construct(private readonly DateTimeImmutable $dateTime)
            {
            }

            public function now(): DateTimeImmutable
            {
                return $this->dateTime;
            }
        };
    }
}
