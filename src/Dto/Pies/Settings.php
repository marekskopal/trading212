<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

use DateTimeImmutable;

/**
 * @phpstan-type SettingsType array{
 *     creationDate: string,
 *     dividendCashAction: string,
 *     endDate: string|null,
 *     goal: int|null,
 *     icon: string|null,
 *     id: int,
 *     initialInvestment: float|null,
 *     instrumentShares: array<string, float>|null,
 *     name: string,
 *     publicUrl: string|null,
 * }
 */
readonly class Settings
{
    /** @param array<string, float> $instrumentShares */
    public function __construct(
        public DateTimeImmutable $creationDate,
        public string $dividendCashAction,
        public ?DateTimeImmutable $endDate,
        public ?int $goal,
        public ?string $icon,
        public int $id,
        public ?float $initialInvestment,
        public ?array $instrumentShares,
        public string $name,
        public ?string $publicUrl,
    ) {
    }

    /** @param SettingsType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            creationDate: new DateTimeImmutable($data['creationDate']),
            dividendCashAction: $data['dividendCashAction'],
            endDate: ($data['endDate'] ?? null) !== null ? new DateTimeImmutable($data['endDate']) : null,
            goal: $data['goal'],
            icon: $data['icon'],
            id: $data['id'],
            initialInvestment: $data['initialInvestment'],
            instrumentShares: $data['instrumentShares'],
            name: $data['name'],
            publicUrl: $data['publicUrl'],
        );
    }
}
