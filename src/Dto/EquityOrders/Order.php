<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\EquityOrders;

use DateTimeImmutable;
use MarekSkopal\Trading212\Dto\Instrument;
use MarekSkopal\Trading212\Enum\InitiatedFromEnum;
use MarekSkopal\Trading212\Enum\OrderStatusEnum;
use MarekSkopal\Trading212\Enum\OrderStrategyEnum;
use MarekSkopal\Trading212\Enum\OrderTypeEnum;
use MarekSkopal\Trading212\Enum\SideEnum;
use MarekSkopal\Trading212\Enum\TimeValidityEnum;

/**
 * @phpstan-import-type InstrumentType from Instrument
 * @phpstan-type OrderType array{
 *     createdAt: string,
 *     currency: string|null,
 *     extendedHours: bool|null,
 *     filledQuantity: float|null,
 *     filledValue: float|null,
 *     id: int,
 *     initiatedFrom: value-of<InitiatedFromEnum>|null,
 *     instrument: InstrumentType|null,
 *     limitPrice: float|null,
 *     quantity: float|null,
 *     side: value-of<SideEnum>|null,
 *     status: value-of<OrderStatusEnum>,
 *     stopPrice: float|null,
 *     strategy: value-of<OrderStrategyEnum>,
 *     ticker: string,
 *     timeInForce: value-of<TimeValidityEnum>|null,
 *     type: value-of<OrderTypeEnum>,
 *     value: float|null,
 *  }
 */
readonly class Order
{
    public function __construct(
        public DateTimeImmutable $createdAt,
        public ?string $currency,
        public ?bool $extendedHours,
        public ?float $filledQuantity,
        public ?float $filledValue,
        public int $id,
        public ?InitiatedFromEnum $initiatedFrom,
        public ?Instrument $instrument,
        public ?float $limitPrice,
        public ?float $quantity,
        public ?SideEnum $side,
        public OrderStatusEnum $status,
        public ?float $stopPrice,
        public OrderStrategyEnum $strategy,
        public string $ticker,
        public ?TimeValidityEnum $timeInForce,
        public OrderTypeEnum $type,
        public ?float $value,
    ) {
    }

    /** @return list<Order> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<OrderType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $order) => self::fromArray($order), $responseContents);
    }

    public static function fromJson(string $json): self
    {
        /** @var OrderType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param OrderType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            createdAt: new DateTimeImmutable($data['createdAt']),
            currency: $data['currency'] ?? null,
            extendedHours: $data['extendedHours'] ?? null,
            filledQuantity: $data['filledQuantity'] ?? null,
            filledValue: $data['filledValue'] ?? null,
            id: $data['id'],
            initiatedFrom: isset($data['initiatedFrom']) ? InitiatedFromEnum::from($data['initiatedFrom']) : null,
            instrument: isset($data['instrument']) ? Instrument::fromArray($data['instrument']) : null,
            limitPrice: $data['limitPrice'] ?? null,
            quantity: $data['quantity'] ?? null,
            side: isset($data['side']) ? SideEnum::from($data['side']) : null,
            status: OrderStatusEnum::from($data['status']),
            stopPrice: $data['stopPrice'] ?? null,
            strategy: OrderStrategyEnum::from($data['strategy']),
            ticker: $data['ticker'],
            timeInForce: isset($data['timeInForce']) ? TimeValidityEnum::from($data['timeInForce']) : null,
            type: OrderTypeEnum::from($data['type']),
            value: $data['value'] ?? null,
        );
    }
}
