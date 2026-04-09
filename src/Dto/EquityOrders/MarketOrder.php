<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\EquityOrders;

readonly class MarketOrder
{
    public function __construct(public float $quantity, public string $ticker, public bool $extendedHours = false,)
    {
    }
}
