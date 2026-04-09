<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

readonly class FillWalletImpact
{
    /** @param list<Tax> $taxes */
    public function __construct(
        public string $currency,
        public float $fxRate,
        public float $netValue,
        public float $realisedProfitLoss,
        public array $taxes,
    ) {
    }

    /**
     * @param array{
     *     currency: string,
     *     fxRate: float,
     *     netValue: float,
     *     realisedProfitLoss: float,
     *     taxes: list<array{
     *         chargedAt: string,
     *         currency: string,
     *         name: string,
     *         quantity: float,
     *     }>,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            currency: $data['currency'],
            fxRate: $data['fxRate'],
            netValue: $data['netValue'],
            realisedProfitLoss: $data['realisedProfitLoss'],
            taxes: array_map(fn(array $tax) => Tax::fromArray($tax), $data['taxes']),
        );
    }
}
