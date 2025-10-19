<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\PersonalPortfolio;

use DateTimeImmutable;
use MarekSkopal\Trading212\Enum\PositionsFrontendEnum;

/**
 * @phpstan-type PositionType array{
 *     averagePrice: float,
 *     currentPrice: float,
 *     frontend: value-of<PositionsFrontendEnum>,
 *     fxPpl: float|null,
 *     initialFillDate: string,
 *     maxBuy: float,
 *     maxSell: float,
 *     pieQuantity: float,
 *     ppl: float,
 *     quantity: float,
 *     ticker: string,
 * }
 */
readonly class Position
{
    public function __construct(
        public float $averagePrice,
        public float $currentPrice,
        public PositionsFrontendEnum $frontend,
        public ?float $fxPpl,
        public DateTimeImmutable $initialFillDate,
        public float $maxBuy,
        public float $maxSell,
        public float $pieQuantity,
        public float $ppl,
        public float $quantity,
        public string $ticker,
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
            averagePrice: $data['averagePrice'],
            currentPrice: $data['currentPrice'],
            frontend: PositionsFrontendEnum::from($data['frontend']),
            fxPpl: $data['fxPpl'],
            initialFillDate: new DateTimeImmutable($data['initialFillDate']),
            maxBuy: $data['maxBuy'],
            maxSell: $data['maxSell'],
            pieQuantity: $data['pieQuantity'],
            ppl: $data['ppl'],
            quantity: $data['quantity'],
            ticker: $data['ticker'],
        );
    }
}
