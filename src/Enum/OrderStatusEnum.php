<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Enum;

enum OrderStatusEnum: string
{
    case Local = 'LOCAL';
    case Unconfirmed = 'UNCONFIRMED';
    case Confirmed = 'CONFIRMED';
    case New = 'NEW';
    case Cancelling = 'CANCELLING';
    case Cancelled = 'CANCELLED';
    case PartiallyFilled = 'PARTIALLY_FILLED';
    case Filled = 'FILLED';
    case Rejected = 'REJECTED';
    case Replacing = 'REPLACING';
    case Replaced = 'REPLACED';
}
