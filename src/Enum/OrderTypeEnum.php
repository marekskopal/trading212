<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Enum;

enum OrderTypeEnum: string
{
    case Limit = 'LIMIT';
    case Stop = 'STOP';
    case Market = 'MARKET';
    case StopLimit = 'STOP_LIMIT';
}
