<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\AccountData\AccountSummary;

readonly class AccountData extends Trading212Api
{
    public function accountSummary(): AccountSummary
    {
        $response = $this->client->get(
            path: '/api/v0/equity/account/summary',
            queryParams: [],
        );

        return AccountSummary::fromJson($response);
    }
}
