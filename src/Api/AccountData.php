<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Dto\AccountData\AccountCash;
use MarekSkopal\Trading212\Dto\AccountData\AccountMetadata;

readonly class AccountData extends Trading212Api
{
    public function accountCash(): AccountCash
    {
        $response = $this->client->get(
            path: '/api/v0/equity/account/cash',
            queryParams: [],
        );

        return AccountCash::fromJson($response);
    }

    public function accountMetadata(): AccountMetadata
    {
        $response = $this->client->get(
            path: '/api/v0/equity/account/info',
            queryParams: [],
        );

        return AccountMetadata::fromJson($response);
    }
}
