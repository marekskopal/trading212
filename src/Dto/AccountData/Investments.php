<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\AccountData;

/**
 * @phpstan-type InvestmentsType array{
 *     currentValue: float,
 *     realizedProfitLoss: float,
 *     totalCost: float,
 *     unrealizedProfitLoss: float,
 * }
 */
readonly class Investments
{
    public function __construct(
        public float $currentValue,
        public float $realizedProfitLoss,
        public float $totalCost,
        public float $unrealizedProfitLoss,
    ) {
    }

    /** @param InvestmentsType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            currentValue: $data['currentValue'],
            realizedProfitLoss: $data['realizedProfitLoss'],
            totalCost: $data['totalCost'],
            unrealizedProfitLoss: $data['unrealizedProfitLoss'],
        );
    }
}
