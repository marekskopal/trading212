<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Tests\Api;

use MarekSkopal\Trading212\Api\AccountData;
use MarekSkopal\Trading212\Api\Trading212Api;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Dto\AccountData\AccountSummary;
use MarekSkopal\Trading212\Dto\AccountData\Cash;
use MarekSkopal\Trading212\Dto\AccountData\Investments;
use MarekSkopal\Trading212\Tests\Fixtures\Client\ClientFixture;
use MarekSkopal\Trading212\Trading212;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(AccountData::class)]
#[UsesClass(Trading212::class)]
#[UsesClass(Client::class)]
#[UsesClass(Config::class)]
#[UsesClass(Trading212Api::class)]
#[UsesClass(AccountSummary::class)]
#[UsesClass(Cash::class)]
#[UsesClass(Investments::class)]
final class AccountDataTest extends TestCase
{
    public function testAccountSummary(): void
    {
        $accountData = new AccountData(ClientFixture::createWithResponse(
            'accountSummaryResponse.json',
        ));

        $accountSummary = $accountData->accountSummary();

        self::assertInstanceOf(AccountSummary::class, $accountSummary);
        self::assertSame('USD', $accountSummary->currency);
        self::assertSame(12345, $accountSummary->id);
        self::assertSame(1000.50, $accountSummary->cash->availableToTrade);
        self::assertSame(5000.00, $accountSummary->investments->currentValue);
    }
}
