<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Enum;

enum TimeValidityEnum: string
{
    case Day = 'DAY';
    case GoodTillCancel = 'GOOD_TILL_CANCEL';
}
