<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\PersonalPortfolio;

use DateTimeImmutable;
use MarekSkopal\Trading212\Dto\Instrument;

/**
 * @phpstan-import-type InstrumentType from Instrument
 * @phpstan-type PositionType array{
 *     averagePricePaid: float,
 *     createdAt: string,
 *     currentPrice: float,
 *     instrument: InstrumentType,
 *     quantity: float,
 *     quantityAvailableForTrading: float,
 *     quantityInPies: float,
 *     walletImpact: array{
 *         currency: string,
 *         currentValue: float,
 *         fxImpact: float,
 *         totalCost: float,
 *         unrealizedProfitLoss: float,
 *     },
 * }
 */
readonly class Position
{
    public function __construct(
        public float $averagePricePaid,
        public DateTimeImmutable $createdAt,
        public float $currentPrice,
        public Instrument $instrument,
        public float $quantity,
        public float $quantityAvailableForTrading,
        public float $quantityInPies,
        public PositionWalletImpact $walletImpact,
    ) {
    }

    /** @return list<Position> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<PositionType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $position) => self::fromArray($position), $responseContents);
    }

    public static function fromJson(string $json): self
    {
        /** @var PositionType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param PositionType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            averagePricePaid: $data['averagePricePaid'],
            createdAt: new DateTimeImmutable($data['createdAt']),
            currentPrice: $data['currentPrice'],
            instrument: Instrument::fromArray($data['instrument']),
            quantity: $data['quantity'],
            quantityAvailableForTrading: $data['quantityAvailableForTrading'],
            quantityInPies: $data['quantityInPies'],
            walletImpact: PositionWalletImpact::fromArray($data['walletImpact']),
        );
    }
}
