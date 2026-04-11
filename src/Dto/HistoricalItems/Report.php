<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\HistoricalItems;

/**
 * @phpstan-type ReportType array{
 *     reportId: int,
 * }
 */
readonly class Report
{
    public function __construct(public int $reportId)
    {
    }

    public static function fromJson(string $json): self
    {
        /** @var ReportType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param ReportType $data */
    public static function fromArray(array $data): self
    {
        return new self(reportId: $data['reportId']);
    }
}
