<?php

namespace Lei\Bitracker\Exchanges\Transformer;

use Lei\Bitracker\Exchanges\Api\BitfinexClient;
use Lei\Bitracker\Exchanges\PriceMappers\Bitfinex as PriceMapper;
use Lei\Bitracker\Exchanges\Struct\Bitfinex as Struct;

/**
 * Class Bitfinex
 * @package Lei\Bitracker\Exchanges\Transformer
 */
class Bitfinex extends TransformerTemplate
{
    /** @var PriceMapper $priceMapper */
    protected $priceMapper;

    /**
     * Bitfinex constructor.
     * @param Struct $struct
     * @param BitfinexClient $client
     * @param PriceMapper $priceMapper
     */
    public function __construct(Struct $struct, BitfinexClient $client, PriceMapper $priceMapper)
    {
        parent::__construct($struct, $client);

        $this->priceMapper = $priceMapper;
    }

    /**
     * @param $balance
     * @param $prices
     * @return array
     */
    protected function processBalance($balance, $prices): array
    {
        $filteredBalance = $this->filterAccount($balance);
        $mapper = $this->priceMapper->getMapper();

        return array_map(function ($balance) use ($prices, $mapper) {
            $symbol = $balance->currency;
            if (array_key_exists($symbol, $mapper)) {
                $symbol = $mapper[$symbol];
            }
            // @todo: check locked amount and price
            $balance->usd = $balance->amount * $prices[strtoupper($symbol)];
            $balance->asset = strtoupper($balance->currency);

            return $balance;
        }, $filteredBalance);
    }

    /**
     * @param $balances
     * @return array
     */
    protected function filterAccount($balances): array
    {
        return array_filter($balances, function ($balance) {
            return $balance->amount && $balance->amount > 0;
        });
    }
}
