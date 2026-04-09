<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\PersonalPortfolio\Position;

readonly class PersonalPortfolio extends Trading212Api
{
    /** @return list<Position> */
    public function allOpenPositions(?string $ticker = null): array
    {
        $queryParams = [];

        if ($ticker !== null) {
            $queryParams['ticker'] = $ticker;
        }

        $response = $this->client->get(path: '/api/v0/equity/positions', queryParams: $queryParams);

        return Position::fromJsonList($response);
    }
}
