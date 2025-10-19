<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\PersonalPortfolio;

readonly class SearchPosition
{
    public function __construct(public string $ticker)
    {
    }
}
