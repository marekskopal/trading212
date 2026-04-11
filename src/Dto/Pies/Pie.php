<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto\Pies;

/**
 * @phpstan-import-type PieInstrumentType from Instrument
 * @phpstan-import-type SettingsType from Settings
 * @phpstan-type PieType array{
 *     instruments: list<PieInstrumentType>,
 *     settings: SettingsType,
 * }
 */
readonly class Pie
{
    /** @param list<Instrument> $instruments */
    public function __construct(public array $instruments, public Settings $settings,)
    {
    }

    public static function fromJson(string $json): self
    {
        /** @var PieType $responseContents */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($responseContents);
    }

    /** @param PieType $data */
    public static function fromArray(array $data): self
    {
        return new self(
            instruments: array_map(
                fn(array $instrument): Instrument => Instrument::fromArray($instrument),
                $data['instruments'],
            ),
            settings: Settings::fromArray($data['settings']),
        );
    }
}
