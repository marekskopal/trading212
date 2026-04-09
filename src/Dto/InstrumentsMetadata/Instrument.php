<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\InstrumentsMetadata;

use DateTimeImmutable;

/**
 * @phpstan-type InstrumentType array{
 *     addedOn: string,
 *     currencyCode: string,
 *     extendedHours: bool|null,
 *     isin: string,
 *     maxOpenQuantity: float,
 *     name: string,
 *     shortName?: string|null,
 *     ticker: string,
 *     type: string,
 *     workingScheduleId: int,
 *  }
 */
readonly class Instrument
{
    public function __construct(
        public DateTimeImmutable $addedOn,
        public string $currencyCode,
        public ?bool $extendedHours,
        public string $isin,
        public float $maxOpenQuantity,
        public string $name,
        public ?string $shortName,
        public string $ticker,
        public string $type,
        public int $workingScheduleId,
    ) {
    }

    /** @return list<Instrument> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<InstrumentType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $exchange) => self::fromArray($exchange), $responseContents);
    }

    /** @param InstrumentType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            addedOn: new DateTimeImmutable($data['addedOn']),
            currencyCode: $data['currencyCode'],
            extendedHours: $data['extendedHours'] ?? null,
            isin: $data['isin'],
            maxOpenQuantity: $data['maxOpenQuantity'],
            name: $data['name'],
            shortName: $data['shortName'] ?? null,
            ticker: $data['ticker'],
            type: $data['type'],
            workingScheduleId: $data['workingScheduleId'],
        );
    }
}
