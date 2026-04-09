<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Tests\Api;

use DateTimeImmutable;
use MarekSkopal\Trading212\Api\HistoricalItems;
use MarekSkopal\Trading212\Api\Trading212Api;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Dto\EquityOrders\Order as EquityOrder;
use MarekSkopal\Trading212\Dto\HistoricalItems\DataIncluded;
use MarekSkopal\Trading212\Dto\HistoricalItems\Dividend;
use MarekSkopal\Trading212\Dto\HistoricalItems\Export;
use MarekSkopal\Trading212\Dto\HistoricalItems\ExportCsv;
use MarekSkopal\Trading212\Dto\HistoricalItems\Fill;
use MarekSkopal\Trading212\Dto\HistoricalItems\FillWalletImpact;
use MarekSkopal\Trading212\Dto\HistoricalItems\Order;
use MarekSkopal\Trading212\Dto\HistoricalItems\Report;
use MarekSkopal\Trading212\Dto\HistoricalItems\Tax;
use MarekSkopal\Trading212\Dto\HistoricalItems\Transaction;
use MarekSkopal\Trading212\Dto\Instrument;
use MarekSkopal\Trading212\Dto\Pagination;
use MarekSkopal\Trading212\Exception\InvalidArgumentException;
use MarekSkopal\Trading212\Tests\Fixtures\Client\ClientFixture;
use MarekSkopal\Trading212\Trading212;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(HistoricalItems::class)]
#[UsesClass(Trading212::class)]
#[UsesClass(Client::class)]
#[UsesClass(Config::class)]
#[UsesClass(Trading212Api::class)]
#[UsesClass(Order::class)]
#[UsesClass(EquityOrder::class)]
#[UsesClass(Fill::class)]
#[UsesClass(FillWalletImpact::class)]
#[UsesClass(Tax::class)]
#[UsesClass(Instrument::class)]
#[UsesClass(Pagination::class)]
#[UsesClass(Dividend::class)]
#[UsesClass(Export::class)]
#[UsesClass(DataIncluded::class)]
#[UsesClass(ExportCsv::class)]
#[UsesClass(Report::class)]
#[UsesClass(Transaction::class)]
final class HistoricalItemsTest extends TestCase
{
    public function testOrders(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'ordersResponse.json',
        ));

        $orders = $historicalItems->orders()->fetchOne();

        self::assertIsArray($orders);
        self::assertNotEmpty($orders);
        self::assertInstanceOf(Order::class, $orders[0]);
    }

    public function testDividends(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'dividendsResponse.json',
        ));

        $dividends = $historicalItems->dividends()->fetchOne();

        self::assertIsArray($dividends);
        self::assertNotEmpty($dividends);
        self::assertInstanceOf(Dividend::class, $dividends[0]);
    }

    public function testExports(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'exportsResponse.json',
        ));

        $exports = $historicalItems->exports();

        self::assertIsArray($exports);
        self::assertNotEmpty($exports);
        self::assertInstanceOf(Export::class, $exports[0]);
    }

    public function testExportCsv(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'exportCsvResponse.json',
        ));

        $exportCsv = $historicalItems->exportCsv(
            new ExportCsv(
                dataIncluded: new DataIncluded(
                    includeDividends: true,
                    includeInterest: true,
                    includeOrders: true,
                    includeTransactions: true,
                ),
                timeFrom: new DateTimeImmutable('2021-01-01'),
                timeTo: new DateTimeImmutable('2021-01-31'),
            ),
        );

        self::assertInstanceOf(Report::class, $exportCsv);
    }

    public function testExportCsvTwoYears(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'exportCsvResponse.json',
        ));

        self::expectException(InvalidArgumentException::class);

        $historicalItems->exportCsv(
            new ExportCsv(
                dataIncluded: new DataIncluded(
                    includeDividends: true,
                    includeInterest: true,
                    includeOrders: true,
                    includeTransactions: true,
                ),
                timeFrom: new DateTimeImmutable('2023-01-01'),
                timeTo: new DateTimeImmutable('2024-01-01'),
            ),
        );
    }

    public function testTransactionList(): void
    {
        $historicalItems = new HistoricalItems(ClientFixture::createWithResponse(
            'transactionListResponse.json',
        ));

        $transactionList = $historicalItems->transactionList()->fetchOne();

        self::assertIsArray($transactionList);
        self::assertNotEmpty($transactionList);
        self::assertInstanceOf(Transaction::class, $transactionList[0]);
    }
}
