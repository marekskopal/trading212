<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

use DateTimeImmutable;

readonly class Tax
{
    public function __construct(public DateTimeImmutable $chargedAt, public string $currency, public string $name, public float $quantity,)
    {
    }

    /**
     * @param array{
     *     chargedAt: string,
     *     currency: string,
     *     name: string,
     *     quantity: float,
     * } $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            chargedAt: new DateTimeImmutable($data['chargedAt']),
            currency: $data['currency'],
            name: $data['name'],
            quantity: $data['quantity'],
        );
    }
}
