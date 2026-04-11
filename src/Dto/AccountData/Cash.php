<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\AccountData;

/**
 * @phpstan-type CashType array{
 *     availableToTrade: float,
 *     inPies: float,
 *     reservedForOrders: float,
 * }
 */
readonly class Cash
{
    public function __construct(public float $availableToTrade, public float $inPies, public float $reservedForOrders,)
    {
    }

    /** @param CashType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            availableToTrade: $data['availableToTrade'],
            inPies: $data['inPies'],
            reservedForOrders: $data['reservedForOrders'],
        );
    }
}
