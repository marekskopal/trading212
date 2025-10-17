<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Api;

use MarekSkopal\Trading212\Client\ClientInterface;

abstract readonly class Trading212Api
{
    public function __construct(protected ClientInterface $client)
    {
    }
}
