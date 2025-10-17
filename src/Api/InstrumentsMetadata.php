<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\InstrumentsMetadata\Exchange;
use MarekSkopal\Trading212\Dto\InstrumentsMetadata\Instrument;

readonly class InstrumentsMetadata extends Trading212Api
{
    /** @return list<Exchange> */
    public function exchangeList(): array
    {
        $response = $this->client->get(
            path: '/api/v0/equity/metadata/exchanges',
            queryParams: [],
        );

        return Exchange::fromJsonList($response);
    }

    /** @return list<Instrument> */
    public function instrumentList(): array
    {
        $response = $this->client->get(
            path: '/api/v0/equity/metadata/instruments',
            queryParams: [],
        );

        return Instrument::fromJsonList($response);
    }
}
