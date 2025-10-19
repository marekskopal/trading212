<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\EquityOrders;

use DateTimeImmutable;
use MarekSkopal\Trading212\Enum\OrderStatusEnum;
use MarekSkopal\Trading212\Enum\OrderStrategyEnum;
use MarekSkopal\Trading212\Enum\OrderTypeEnum;

/**
 * @phpstan-type OrderType array{
 *     creationTime: string,
 *     filledQuantity: float,
 *     filledValue: float,
 *     id: int,
 *     limitPrice: float,
 *     quantity: float,
 *     status: value-of<OrderStatusEnum>,
 *     stopPrice: float,
 *     strategy: value-of<OrderStrategyEnum>,
 *     ticker: string,
 *     type: value-of<OrderTypeEnum>,
 *     value: float,
 *  }
 */
readonly class Order
{
    public function __construct(
        public DateTimeImmutable $creationTime,
        public float $filledQuantity,
        public float $filledValue,
        public int $id,
        public float $limitPrice,
        public float $quantity,
        public OrderStatusEnum $status,
        public float $stopPrice,
        public OrderStrategyEnum $strategy,
        public string $ticker,
        public OrderTypeEnum $type,
        public float $value,
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
            creationTime: new DateTimeImmutable($data['creationTime']),
            filledQuantity: $data['filledQuantity'],
            filledValue: $data['filledValue'],
            id: $data['id'],
            limitPrice: $data['limitPrice'],
            quantity: $data['quantity'],
            status: OrderStatusEnum::from($data['status']),
            stopPrice: $data['stopPrice'],
            strategy: OrderStrategyEnum::from($data['strategy']),
            ticker: $data['ticker'],
            type: OrderTypeEnum::from($data['type']),
            value: $data['value'],
        );
    }
}
