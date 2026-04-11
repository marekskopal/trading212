<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

use DateTimeImmutable;

/**
 * @phpstan-import-type FillWalletImpactType from FillWalletImpact
 * @phpstan-type FillType array{
 *     filledAt: string|null,
 *     id: int|null,
 *     price: float|null,
 *     quantity: float|null,
 *     tradingMethod: string|null,
 *     type: string|null,
 *     walletImpact: FillWalletImpactType|null,
 * }
 */
readonly class Fill
{
    public function __construct(
        public ?DateTimeImmutable $filledAt,
        public ?int $id,
        public ?float $price,
        public ?float $quantity,
        public ?string $tradingMethod,
        public ?string $type,
        public ?FillWalletImpact $walletImpact,
    ) {
    }

    /** @param FillType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            filledAt: isset($data['filledAt']) ? new DateTimeImmutable($data['filledAt']) : null,
            id: $data['id'] ?? null,
            price: $data['price'] ?? null,
            quantity: $data['quantity'] ?? null,
            tradingMethod: $data['tradingMethod'] ?? null,
            type: $data['type'] ?? null,
            walletImpact: isset($data['walletImpact']) ? FillWalletImpact::fromArray($data['walletImpact']) : null,
        );
    }
}
