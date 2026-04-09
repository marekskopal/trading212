<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto;

/**
 * @phpstan-type InstrumentType array{
 *     currency: string,
 *     isin: string,
 *     name: string,
 *     ticker: string,
 * }
 */
readonly class Instrument
{
    public function __construct(public string $currency, public string $isin, public string $name, public string $ticker,)
    {
    }

    /** @param InstrumentType $data */
    public static function fromArray(array $data): self
    {
        return new self(currency: $data['currency'], isin: $data['isin'], name: $data['name'], ticker: $data['ticker']);
    }
}
