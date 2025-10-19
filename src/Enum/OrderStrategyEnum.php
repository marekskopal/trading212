<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Enum;

enum OrderStrategyEnum: string
{
    case Quantity = 'QUANTITY';
    case Value = 'VALUE';
}
