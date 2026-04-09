<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Dto;

use Iterator;
use MarekSkopal\Trading212\Client\ClientInterface;
use MarekSkopal\Trading212\Exception\InternalServerErrorException;

/** @template T */
readonly class Pagination
{
    /**
     * @param class-string<T> $dtoClass
     * @param T[] $items
     */
    public function __construct(public ClientInterface $client, public string $dtoClass, public array $items, public ?string $nextPagePath)
    {
    }

    /**
     * @param class-string<T> $dtoClass
     * @return self<T>
     */
    public static function fromJson(ClientInterface $client, string $dtoClass, string $json): self
    {
        /**
         * @var array{
         *     items: list<array<string, scalar|array<string|int, scalar|array<string, scalar|null>|null>|null>>,
         *     nextPagePath: string|null,
         * } $responseContents
         */
        $responseContents = json_decode($json, associative: true);

        return self::fromArray($client, $dtoClass, $responseContents);
    }

    /**
     * @param class-string<T> $dtoClass
     * @param array{
     *     items: list<array<string, scalar|array<string|int, scalar|array<string, scalar|null>|null>|null>>,
     *     nextPagePath: string|null,
     * } $data
     * @return self<T>
     */
    public static function fromArray(ClientInterface $client, string $dtoClass, array $data): self
    {
        return new self(
            client: $client,
            dtoClass: $dtoClass,
            items: $dtoClass::fromArrayList($data['items']),
            nextPagePath: $data['nextPagePath'],
        );
    }

    /** @return T[] */
    public function fetchOne(): array
    {
         return $this->items;
    }

    /** @return Iterator<T> */
    public function fetchAll(): Iterator
    {
        foreach ($this->items as $item) {
            yield $item;
        }

        if ($this->nextPagePath === null) {
            return;
        }

        try {
            $response = $this->client->get($this->nextPagePath, []);
        } catch (InternalServerErrorException) {
            // current Trading 212 API sometimes returns 500 Internal Server Error
            return;
        }

        $pagination = self::fromJson($this->client, $this->dtoClass, $response);

        yield from $pagination->fetchAll();
    }
}
