<?php

declare(strict_types=1);

namespace SuperUmbrella\Shop\Shared;

use DateTimeImmutable;

final class DateTimeHelper
{
    public const DEFAULT_FORMAT = 'Y-m-d H:i:s';
    public const DEFAULT_TIMEZONE = 'Europe\Warsaw';

    public static function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', new \DateTimeZone(self::DEFAULT_TIMEZONE));
    }

    public static function format(\DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::DEFAULT_FORMAT);
    }

    public static function from(string $dateTime, string $format = self::DEFAULT_FORMAT): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat($format, $dateTime);
    }
}