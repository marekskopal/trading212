<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Utils;

use DateTimeInterface;

readonly class DateTimeUtils
{
    private const FormatZulu = 'Y-m-d\TH:i:sp';

    public static function formatZulu(DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::FormatZulu);
    }
}
