<?php

namespace Lei\Bitracker\Exchanges\Transformer;

use Lei\Bitracker\Exchanges\Api\HitBtcClient;
use Lei\Bitracker\Exchanges\Struct\HitBtc as Struct;

/**
 * Class HitBtc
 * @package Lei\Bitracker\Exchanges\Transformer
 */
class HitBtc extends TransformerTemplate
{
    /**
     * HitBtc constructor.
     * @param Struct $struct
     * @param HitBtcClient $client
     */
    public function __construct(Struct $struct, HitBtcClient $client)
    {
        parent::__construct($struct, $client);
    }

    /**
     * @return array|mixed
     */
    protected function getBalanceFromApi()
    {
        $accountBalances = $this->client->getBalances();
        $tradingBalances = $this->client->getTradingBalances();

        return array_merge($tradingBalances, $accountBalances);
    }

    protected function processBalance($balanceRaw, $prices): array
    {
        $filteredAccount = $this->filterAccount($balanceRaw);

        return array_map(function ($balance) use ($prices) {
            $symbol = $balance->currency; // @todo: check reserved
            $balance->usd = $balance->available * $prices[$symbol];
            $balance->amount = $balance->available;
            $balance->asset = $balance->currency;

            return $balance;
        }, $filteredAccount);
    }

    /**
     * @param $binance
     * @return array
     */
    protected function filterAccount($binance): array
    {
        return array_filter($binance, function ($balance) {
            return $balance->available && $balance->available > 0;
        });
    }
}
