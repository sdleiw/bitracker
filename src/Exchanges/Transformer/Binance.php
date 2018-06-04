<?php

namespace Lei\Bitracker\Exchanges\Transformer;

use Lei\Bitracker\Exchanges\Api\BinanceClient;
use Lei\Bitracker\Exchanges\Struct\Binance as Struct;
use Lei\Bitracker\Exchanges\PriceMappers\Binance as PriceMapper;

/**
 * Class Binance
 * @package Lei\Bitracker\Exchanges\Transformer
 */
class Binance extends TransformerTemplate
{
    /**
     * @var PriceMapper $priceMapper
     */
    protected $priceMapper;

    /**
     * Binance constructor.
     * @param Struct $struct
     * @param BinanceClient $client
     * @param PriceMapper $priceMapper
     */
    public function __construct(Struct $struct, BinanceClient $client, PriceMapper $priceMapper)
    {
        parent::__construct($struct, $client);

        $this->priceMapper = $priceMapper;
    }

    protected function processBalance($balance, $prices): array
    {
        $filteredAccount = $this->filterAccount($balance);
        $mapper = $this->priceMapper->getMapper();

        return array_map(function ($balance) use ($prices, $mapper) {
            $symbol = $balance->asset;
            if (array_key_exists($symbol, $mapper)) {
                $symbol = strtoupper($mapper[$symbol]);
            }
            $price = $prices[$symbol] ?? 0;
            $balance->usd = ($balance->free + $balance->locked) * $price;
            $balance->amount = $balance->free + $balance->locked;

            return $balance;
        }, $filteredAccount);
    }

    /**
     * @param $binance
     * @return array
     */
    protected function filterAccount($binance): array
    {
        return array_filter($binance->balances, function ($balance) {
            return ($balance->free && $balance->free > 0) || ($balance->locked && $balance->locked > 0);
        });
    }
}
