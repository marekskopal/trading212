<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Tests\Api;

use MarekSkopal\Trading212\Api\EquityOrders;
use MarekSkopal\Trading212\Api\Trading212Api;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Dto\EquityOrders\LimitOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\MarketOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\Order;
use MarekSkopal\Trading212\Dto\EquityOrders\StopLimitOrder;
use MarekSkopal\Trading212\Dto\EquityOrders\StopOrder;
use MarekSkopal\Trading212\Dto\Instrument;
use MarekSkopal\Trading212\Enum\TimeValidityEnum;
use MarekSkopal\Trading212\Tests\Fixtures\Client\ClientFixture;
use MarekSkopal\Trading212\Trading212;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EquityOrders::class)]
#[UsesClass(Trading212::class)]
#[UsesClass(Client::class)]
#[UsesClass(Config::class)]
#[UsesClass(Trading212Api::class)]
#[UsesClass(Order::class)]
#[UsesClass(Instrument::class)]
#[UsesClass(LimitOrder::class)]
#[UsesClass(MarketOrder::class)]
#[UsesClass(StopOrder::class)]
#[UsesClass(StopLimitOrder::class)]
final class EquityOrdersTest extends TestCase
{
    public function testFetchAll(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrdersResponse.json',
        ));

        $orders = $equityOrders->fetchAll();

        self::assertIsArray($orders);
        self::assertNotEmpty($orders);
        self::assertInstanceOf(Order::class, $orders[0]);
    }

    public function testPlaceLimitOrder(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrderResponse.json',
        ));

        $order = new LimitOrder(limitPrice: 100, quantity: 1, ticker: 'AAPL', timeValidity: TimeValidityEnum::Day);

        $order = $equityOrders->placeLimitOrder($order);

        self::assertInstanceOf(Order::class, $order);
    }

    public function testPlaceMarketOrder(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrderResponse.json',
        ));

        $order = new MarketOrder(quantity: 1, ticker: 'AAPL');

        $order = $equityOrders->placeMarketOrder($order);

        self::assertInstanceOf(Order::class, $order);
    }

    public function testPlaceStopOrder(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrderResponse.json',
        ));

        $order = new StopOrder(quantity: 1, stopPrice: 100, ticker: 'AAPL', timeValidity: TimeValidityEnum::Day);

        $order = $equityOrders->placeStopOrder($order);

        self::assertInstanceOf(Order::class, $order);
    }

    public function testPlaceStopLimitOrder(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrderResponse.json',
        ));

        $order = new StopLimitOrder(limitPrice: 100, quantity: 1, stopPrice: 100, ticker: 'AAPL', timeValidity: TimeValidityEnum::Day);

        $order = $equityOrders->placeStopLimitOrder($order);

        self::assertInstanceOf(Order::class, $order);
    }

    public function testFetch(): void
    {
        $equityOrders = new EquityOrders(ClientFixture::createWithResponse(
            'equityOrderResponse.json',
        ));

        $order = $equityOrders->fetch(1);

        self::assertInstanceOf(Order::class, $order);
    }
}
