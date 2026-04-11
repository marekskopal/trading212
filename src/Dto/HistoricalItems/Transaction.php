<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

use DateTimeImmutable;

/**
 * @phpstan-type TransactionType array{
 *     amount: float,
 *     currency: string|null,
 *     dateTime: string,
 *     reference: string,
 *     type: string,
 * }
 */
readonly class Transaction
{
    public function __construct(
        public float $amount,
        public ?string $currency,
        public DateTimeImmutable $dateTime,
        public string $reference,
        public string $type,
    ) {
    }

    /**
     * @param list<TransactionType> $data
     * @return list<Transaction>
     */
    public static function fromArrayList(array $data): array
    {
        return array_map(fn(array $order) => self::fromArray($order), $data);
    }

    /** @param TransactionType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: $data['amount'],
            currency: $data['currency'] ?? null,
            dateTime: new DateTimeImmutable($data['dateTime']),
            reference: $data['reference'],
            type: $data['type'],
        );
    }
}
