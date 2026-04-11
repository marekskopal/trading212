<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

/**
 * @phpstan-type DividendDetailType array{
 *     gained: float,
 *     inCash: float,
 *     reinvested: float,
 * }
 */
readonly class DividendDetail
{
    public function __construct(public float $gained, public float $inCash, public float $reinvested)
    {
    }

    /** @param DividendDetailType $data */
    public static function fromArray(array $data): self
    {
        return new self(gained: $data['gained'], inCash: $data['inCash'], reinvested: $data['reinvested']);
    }
}
