<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Tests\Api;

use MarekSkopal\Trading212\Api\Pies;
use MarekSkopal\Trading212\Api\Trading212Api;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Dto\Pies\CreatePie;
use MarekSkopal\Trading212\Dto\Pies\DividendDetail;
use MarekSkopal\Trading212\Dto\Pies\Instrument;
use MarekSkopal\Trading212\Dto\Pies\Pie;
use MarekSkopal\Trading212\Dto\Pies\PieItem;
use MarekSkopal\Trading212\Dto\Pies\Result;
use MarekSkopal\Trading212\Dto\Pies\Settings;
use MarekSkopal\Trading212\Tests\Fixtures\Client\ClientFixture;
use MarekSkopal\Trading212\Tests\Fixtures\Dto\CreatePieFixture;
use MarekSkopal\Trading212\Trading212;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Pies::class)]
#[UsesClass(Trading212::class)]
#[UsesClass(Client::class)]
#[UsesClass(Config::class)]
#[UsesClass(Trading212Api::class)]
#[UsesClass(PieItem::class)]
#[UsesClass(DividendDetail::class)]
#[UsesClass(Result::class)]
#[UsesClass(Pie::class)]
#[UsesClass(Instrument::class)]
#[UsesClass(Settings::class)]
#[UsesClass(CreatePie::class)]
final class PiesTest extends TestCase
{
    public function testPies(): void
    {
        $pies = new Pies(ClientFixture::createWithResponse(
            'piesResponse.json',
        ));

        $pies = $pies->fetchAll();

        self::assertIsArray($pies);
        self::assertNotEmpty($pies);
        self::assertInstanceOf(PieItem::class, $pies[0]);
    }

    public function testCreatePie(): void
    {
        $pies = new Pies(ClientFixture::createWithResponse(
            'pieResponse.json',
        ));

        $createPie = $pies->createPie(CreatePieFixture::create());

        self::assertInstanceOf(Pie::class, $createPie);
    }

    public function testPie(): void
    {
        $pies = new Pies(ClientFixture::createWithResponse(
            'pieResponse.json',
        ));

        $pie = $pies->pie(1);

        self::assertInstanceOf(Pie::class, $pie);
    }

    public function testUpdatePie(): void
    {
        $pies = new Pies(ClientFixture::createWithResponse(
            'pieResponse.json',
        ));

        $pie = $pies->updatePie(CreatePieFixture::create(), 1);

        self::assertInstanceOf(Pie::class, $pie);
    }
}
