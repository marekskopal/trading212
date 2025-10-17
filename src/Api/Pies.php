<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\Pies\CreatePie;
use MarekSkopal\Trading212\Dto\Pies\Pie;
use MarekSkopal\Trading212\Dto\Pies\PieItem;

readonly class Pies extends Trading212Api
{
    /** @return list<PieItem> */
    public function pies(): array
    {
        $response = $this->client->get(
            path: '/api/v0/equity/pies',
            queryParams: [],
        );

        return PieItem::fromJsonList($response);
    }

    public function createPie(CreatePie $pie): Pie
    {
        $response = $this->client->post(
            path: '/api/v0/equity/pies',
            queryParams: [],
            body: $pie,
        );

        return Pie::fromJson($response);
    }

    public function pie(int $pieId): Pie
    {
        $response = $this->client->get(
            path: '/api/v0/equity/pies/' . $pieId,
            queryParams: [],
        );

        return Pie::fromJson($response);
    }

    public function deletePie(int $pieId): void
    {
        $this->client->delete(
            path: '/api/v0/equity/pies/' . $pieId,
            queryParams: [],
        );
    }

    public function updatePie(CreatePie $pie, int $pieId): Pie
    {
        $response = $this->client->post(
            path: '/api/v0/equity/pies/' . $pieId,
            queryParams: [],
            body: $pie,
        );

        return Pie::fromJson($response);
    }
}
