<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\PersonalPortfolio\Position;
use MarekSkopal\Trading212\Dto\PersonalPortfolio\SearchPosition;

readonly class PersonalPortfolio extends Trading212Api
{
    /** @return list<Position> */
    public function allOpenPositions(): array
    {
        $response = $this->client->get(
            path: '/api/v0/equity/portfolio',
            queryParams: [],
        );

        return Position::fromJsonList($response);
    }

    public function position(string $ticker): Position
    {
        $response = $this->client->get(
            path: '/api/v0/equity/portfolio' . $ticker,
            queryParams: [],
        );

        return Position::fromJson($response);
    }

    public function searchPosition(string $ticker): Position
    {
        $response = $this->client->post(
            path: '/api/v0/equity/portfolio' . $ticker,
            queryParams: [],
            body: new SearchPosition($ticker),
        );

        return Position::fromJson($response);
    }
}
