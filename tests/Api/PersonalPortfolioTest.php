<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Tests\Api;

use MarekSkopal\Trading212\Api\PersonalPortfolio;
use MarekSkopal\Trading212\Api\Trading212Api;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Dto\PersonalPortfolio\Position;
use MarekSkopal\Trading212\Dto\PersonalPortfolio\SearchPosition;
use MarekSkopal\Trading212\Tests\Fixtures\Client\ClientFixture;
use MarekSkopal\Trading212\Trading212;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PersonalPortfolio::class)]
#[UsesClass(Trading212::class)]
#[UsesClass(Client::class)]
#[UsesClass(Config::class)]
#[UsesClass(Trading212Api::class)]
#[UsesClass(Position::class)]
#[UsesClass(SearchPosition::class)]
final class PersonalPortfolioTest extends TestCase
{
    public function testAllOpenPositions(): void
    {
        $personalPortfolio = new PersonalPortfolio(ClientFixture::createWithResponse(
            'positionsResponse.json',
        ));

        $positions = $personalPortfolio->allOpenPositions();

        self::assertIsArray($positions);
        self::assertNotEmpty($positions);
        self::assertInstanceOf(Position::class, $positions[0]);
    }

    public function testPosition(): void
    {
        $personalPortfolio = new PersonalPortfolio(ClientFixture::createWithResponse(
            'positionResponse.json',
        ));

        $position = $personalPortfolio->position('AAPL');

        self::assertInstanceOf(Position::class, $position);
    }

    public function testSearchPosition(): void
    {
        $personalPortfolio = new PersonalPortfolio(ClientFixture::createWithResponse(
            'positionResponse.json',
        ));

        $position = $personalPortfolio->searchPosition('AAPL');

        self::assertInstanceOf(Position::class, $position);
    }
}
