<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212\Client;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use MarekSkopal\Trading212\Config\Config;
use MarekSkopal\Trading212\Exception\ApiException;
use MarekSkopal\Trading212\Exception\TooManyRequestsException;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

readonly class Client implements ClientInterface
{
    private const BaseUri = 'https://live.trading212.com';
    private const DemoBaseUri = 'https://demo.trading212.com';

    private \Psr\Http\Client\ClientInterface $httpClient;

    private RequestFactoryInterface $requestFactory;

    private StreamFactoryInterface $streamFactory;

    public function __construct(private Config $config)
    {
        $this->httpClient = Psr18ClientDiscovery::find();
        $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
    }

    /** @param array<string, scalar|null> $queryParams */
    public function get(string $path, array $queryParams, int $retryCount = 0): string
    {
        return $this->request('GET', $path, $queryParams, null, $retryCount);
    }

    /** @param array<string, scalar|null> $queryParams */
    public function post(string $path, array $queryParams, object $body, int $retryCount = 0): string
    {
        return $this->request('POST', $path, $queryParams, $body, $retryCount);
    }

    /** @param array<string, scalar|null> $queryParams */
    public function delete(string $path, array $queryParams, int $retryCount = 0): string
    {
        return $this->request('DELETE', $path, $queryParams, null, $retryCount);
    }

    /** @param array<string, scalar|null> $queryParams */
    private function request(string $method, string $path, array $queryParams, ?object $body, int $retryCount = 0): string
    {
        $uri = $this->getBaseUri() . $path;

        if (count($queryParams) > 0) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $request = $this->requestFactory->createRequest($method, $uri);

        $request = $this->addHeaders($request);

        if ($body !== null) {
            $request = $request->withBody(
                $this->streamFactory->createStream((string) json_encode($body)),
            );
        }

        $response = $this->httpClient->sendRequest($request);

        try {
            return $this->getContents($response);
        } catch (TooManyRequestsException $e) {
            if (
                $this->config->tooManyRequestsRepeat <= 0
                || $this->config->tooManyRequestsWaitTime <= 0
                || $retryCount >= $this->config->tooManyRequestsRepeat
            ) {
                throw $e;
            }

            sleep($this->config->tooManyRequestsWaitTime);

            return $this->request($method, $path, $queryParams, $body, $retryCount + 1);
        }
    }

    private function getContents(ResponseInterface $response): string
    {
        if ($response->getStatusCode() !== 200) {
            throw ApiException::fromCode($response->getStatusCode());
        }

        return $response->getBody()->getContents();
    }

    private function addHeaders(RequestInterface $request): RequestInterface
    {
        if ($this->config->apiSecret !== null) {
            $credentials = base64_encode($this->config->apiKey . ':' . $this->config->apiSecret);
            $authorization = 'Basic ' . $credentials;
        } else {
            $authorization = $this->config->apiKey;
        }

        return $request
            ->withHeader('User-Agent', 'marekskopal/trading212-client:1.0.0')
            ->withHeader('Authorization', $authorization)
            ->withHeader('Content-Type', 'application/json');
    }

    private function getBaseUri(): string
    {
        return $this->config->demo ? self::DemoBaseUri : self::BaseUri;
    }
}
