<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

use MarekSkopal\Trading212\Dto\EquityOrders\Order as EquityOrder;

/**
 * @phpstan-import-type OrderType from EquityOrder
 * @phpstan-import-type FillType from Fill
 * @phpstan-type HistoricalOrderType array{
 *     order: OrderType,
 *     fill: FillType|null,
 * }
 */
readonly class Order
{
    public function __construct(public EquityOrder $order, public ?Fill $fill,)
    {
    }

    /**
     * @param list<HistoricalOrderType> $data
     * @return list<Order>
     */
    public static function fromArrayList(array $data): array
    {
        return array_map(fn(array $order) => self::fromArray($order), $data);
    }

    /** @param HistoricalOrderType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            order: EquityOrder::fromArray($data['order']),
            fill: isset($data['fill']) ? Fill::fromArray($data['fill']) : null,
        );
    }
}
