<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\AccountData;

readonly class Cash
{
    public function __construct(public float $availableToTrade, public float $inPies, public float $reservedForOrders,)
    {
    }

    /**
     * @param array{
     *     availableToTrade: float,
     *     inPies: float,
     *     reservedForOrders: float,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            availableToTrade: $data['availableToTrade'],
            inPies: $data['inPies'],
            reservedForOrders: $data['reservedForOrders'],
        );
    }
}
