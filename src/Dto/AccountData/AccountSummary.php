<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\AccountData;

/**
 * @phpstan-import-type CashType from Cash
 * @phpstan-import-type InvestmentsType from Investments
 * @phpstan-type AccountSummaryType array{
 *     cash: CashType,
 *     currency: string,
 *     id: int,
 *     investments: InvestmentsType,
 *     totalValue: float,
 * }
 */
readonly class AccountSummary
{
    public function __construct(
        public Cash $cash,
        public string $currency,
        public int $id,
        public Investments $investments,
        public float $totalValue,
    ) {
    }

    public static function fromJson(string $json): self
    {
        /** @var AccountSummaryType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param AccountSummaryType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            cash: Cash::fromArray($data['cash']),
            currency: $data['currency'],
            id: $data['id'],
            investments: Investments::fromArray($data['investments']),
            totalValue: $data['totalValue'],
        );
    }
}
