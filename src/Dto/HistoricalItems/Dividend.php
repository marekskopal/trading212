<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

use DateTimeImmutable;
use MarekSkopal\Trading212\Dto\Instrument;

/**
 * @phpstan-import-type InstrumentType from Instrument
 * @phpstan-type DividendType array{
 *     amount: float,
 *     amountInEuro: float,
 *     currency: string|null,
 *     grossAmountPerShare: float,
 *     instrument: InstrumentType|null,
 *     paidOn: string,
 *     quantity: float,
 *     reference: string,
 *     ticker: string,
 *     tickerCurrency: string|null,
 *     type: string,
 * }
 */
readonly class Dividend
{
    public function __construct(
        public float $amount,
        public float $amountInEuro,
        public ?string $currency,
        public float $grossAmountPerShare,
        public ?Instrument $instrument,
        public DateTimeImmutable $paidOn,
        public float $quantity,
        public string $reference,
        public string $ticker,
        public ?string $tickerCurrency,
        public string $type,
    ) {
    }

    /**
     * @param list<DividendType> $data
     * @return list<Dividend>
     */
    public static function fromArrayList(array $data): array
    {
        return array_map(fn(array $order) => self::fromArray($order), $data);
    }

    /** @param DividendType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            amountInEuro: $data['amountInEuro'],
            currency: $data['currency'] ?? null,
            grossAmountPerShare: $data['grossAmountPerShare'],
            instrument: isset($data['instrument']) ? Instrument::fromArray($data['instrument']) : null,
            paidOn: new DateTimeImmutable($data['paidOn']),
            quantity: $data['quantity'],
            reference: $data['reference'],
            ticker: $data['ticker'],
            tickerCurrency: $data['tickerCurrency'] ?? null,
            type: $data['type'],
        );
    }
}
