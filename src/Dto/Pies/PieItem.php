<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

/**
 * @phpstan-import-type DividendDetailType from DividendDetail
 * @phpstan-import-type ResultType from Result
 * @phpstan-type PieItemType array{
 *     cash: float,
 *     dividendDetails: DividendDetailType,
 *     id: int,
 *     progress: float|null,
 *     result: ResultType,
 *     status: string|null,
 * }
 */
readonly class PieItem
{
    public function __construct(
        public float $cash,
        public DividendDetail $dividendDetails,
        public int $id,
        public ?float $progress,
        public Result $result,
        public ?string $status,
    ) {
    }

    /** @return list<PieItem> */
    public static function fromJsonList(string $json): array
    {
        /** @var list<PieItemType> $responseContents */
        $responseContents = json_decode($json, associative: true);

        return array_map(fn(array $exchange) => self::fromArray($exchange), $responseContents);
    }

    /** @param PieItemType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            cash: $data['cash'],
            dividendDetails: DividendDetail::fromArray($data['dividendDetails']),
            id: $data['id'],
            progress: $data['progress'],
            result: Result::fromArray($data['result']),
            status: $data['status'],
        );
    }
}
