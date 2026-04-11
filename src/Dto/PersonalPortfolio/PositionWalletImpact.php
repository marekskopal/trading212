<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\PersonalPortfolio;

/**
 * @phpstan-type PositionWalletImpactType array{
 *     currency: string,
 *     currentValue: float,
 *     fxImpact: float,
 *     totalCost: float,
 *     unrealizedProfitLoss: float,
 * }
 */
readonly class PositionWalletImpact
{
    public function __construct(
        public string $currency,
        public float $currentValue,
        public float $fxImpact,
        public float $totalCost,
        public float $unrealizedProfitLoss,
    ) {
    }

    /** @param PositionWalletImpactType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            currentValue: $data['currentValue'],
            fxImpact: $data['fxImpact'],
            totalCost: $data['totalCost'],
            unrealizedProfitLoss: $data['unrealizedProfitLoss'],
        );
    }
}
