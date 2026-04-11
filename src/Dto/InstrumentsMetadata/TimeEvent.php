<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\InstrumentsMetadata;

use DateTimeImmutable;

/**
 * @phpstan-type TimeEventType array{
 *     date: string,
 *     type: string,
 * }
 */
readonly class TimeEvent
{
    public function __construct(public DateTimeImmutable $date, public string $type)
    {
    }

    /** @param TimeEventType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            date: new DateTimeImmutable($data['date']),
            type: $data['type'],
        );
    }
}
