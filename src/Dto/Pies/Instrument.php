<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

/**
 * @phpstan-import-type IssueType from Issue
 * @phpstan-import-type ResultType from Result
 * @phpstan-type PieInstrumentType array{
 *     currentShare: float,
 *     expectedShare: float,
 *     issues: list<IssueType>,
 *     ownedQuantity: float,
 *     result: ResultType,
 *     ticker: string,
 * }
 */
readonly class Instrument
{
    /** @param list<Issue> $issues */
    public function __construct(
        public float $currentShare,
        public float $expectedShare,
        public array $issues,
        public float $ownedQuantity,
        public Result $result,
        public string $ticker,
    ) {
    }

    /** @param PieInstrumentType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            currentShare: $data['currentShare'],
            expectedShare: $data['expectedShare'],
            issues: array_map(
                fn(array $issue): Issue => Issue::fromArray($issue),
                $data['issues'],
            ),
            ownedQuantity: $data['ownedQuantity'],
            result: Result::fromArray($data['result']),
            ticker: $data['ticker'],
        );
    }
}
