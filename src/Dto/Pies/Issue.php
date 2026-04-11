<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

/**
 * @phpstan-type IssueType array{
 *     name: string,
 *     severity: string,
 * }
 */
readonly class Issue
{
    public function __construct(public string $name, public string $severity,)
    {
    }

    /** @param IssueType $data */
    public static function fromArray(array $data): self
    {
        return new self(name: $data['name'], severity: $data['severity']);
    }
}
