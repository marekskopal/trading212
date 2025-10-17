<?php

declare(strict_types=1);

namespace MarekSkopal\Trading212;

use MarekSkopal\Trading212\Api\AccountData;
use MarekSkopal\Trading212\Api\EquityOrders;
use MarekSkopal\Trading212\Api\HistoricalItems;
use MarekSkopal\Trading212\Api\InstrumentsMetadata;
use MarekSkopal\Trading212\Api\PersonalPortfolio;
use MarekSkopal\Trading212\Api\Pies;
use MarekSkopal\Trading212\Client\Client;
use MarekSkopal\Trading212\Config\Config;

readonly class Trading212
{
    private Client $client;

    public InstrumentsMetadata $instrumentsMetadata;

    public Pies $pies;

    public EquityOrders $equityOrders;

    public AccountData $accountData;

    public PersonalPortfolio $personalPortfolio;

    public HistoricalItems $historicalItems;

    public function __construct(Config $config)
    {
        $this->client = new Client($config);

        $this->instrumentsMetadata = new InstrumentsMetadata($this->client);
        $this->pies = new Pies($this->client);
        $this->equityOrders = new EquityOrders($this->client);
        $this->accountData = new AccountData($this->client);
        $this->personalPortfolio = new PersonalPortfolio($this->client);
        $this->historicalItems = new HistoricalItems($this->client);
    }

    public function getInstrumentsMetadata(): InstrumentsMetadata
    {
        return $this->instrumentsMetadata;
    }

    public function getPies(): Pies
    {
        return $this->pies;
    }

    public function getEquityOrders(): EquityOrders
    {
        return $this->equityOrders;
    }

    public function getAccountData(): AccountData
    {
        return $this->accountData;
    }

    public function getPersonalPortfolio(): PersonalPortfolio
    {
        return $this->personalPortfolio;
    }

    public function getHistoricalItems(): HistoricalItems
    {
        return $this->historicalItems;
    }
}
