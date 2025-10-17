<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\EquityOrders\LimitOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\MarketOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\Order;
use MarekSkopal\Trading212\Dto\EquityOrders\StopLimitOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\StopOrder;

readonly class EquityOrders extends Trading212Api
{
    /** @return list<Order> */
    public function fetchAll(): array
    {
        $response = $this->client->get(
            path: '/api/v0/equity/orders',
            queryParams: [],
        );

        return Order::fromJsonList($response);
    }

    public function placeLimitOrder(LimitOrder $order): Order
    {
        $response = $this->client->post(
            path: '/api/v0/equity/orders/limit',
            queryParams: [],
            body: $order,
        );

        return Order::fromJson($response);
    }

    public function placeMarketOrder(MarketOrder $order): Order
    {
        $response = $this->client->post(
            path: '/api/v0/equity/orders/market',
            queryParams: [],
            body: $order,
        );

        return Order::fromJson($response);
    }

    public function placeStopOrder(StopOrder $order): Order
    {
        $response = $this->client->post(
            path: '/api/v0/equity/orders/stop',
            queryParams: [],
            body: $order,
        );

        return Order::fromJson($response);
    }

    public function placeStopLimitOrder(StopLimitOrder $order): Order
    {
        $response = $this->client->post(
            path: '/api/v0/equity/orders/stop_limit',
            queryParams: [],
            body: $order,
        );

        return Order::fromJson($response);
    }

    public function cancelOrder(int $orderId): void
    {
        $this->client->delete(
            path: '/api/v0/equity/orders/' . $orderId,
            queryParams: [],
        );
    }

    public function fetch(int $orderId): Order
    {
        $response = $this->client->get(
            path: '/api/v0/equity/orders/' . $orderId,
            queryParams: [],
        );

        return Order::fromJson($response);
    }
}
