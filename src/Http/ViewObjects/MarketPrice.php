<?php

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\CoinMarketCap\ApiClient;

/**
 * Class MarketPrice
 * @package Lei\Bitracker\Http\ViewObjects
 */
class MarketPrice
{
    const CACHE_KEY = 'coinmarketcap-api';
    const CACHE_TTL_MINUTES = 5;

    /** @var array */
    protected $marketPrices;

    /** @var ApiClient $tickerApi */
    protected $tickerApi;

    /**
     * Price constructor.
     * @param ApiClient $tickerApi
     */
    public function __construct(ApiClient $tickerApi)
    {
        $this->tickerApi = $tickerApi;
    }

    /**
     * @param int $total
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchPrices($total = 500):array
    {
        $cache = app('cache');
        if ($cache->has(self::CACHE_KEY)) {
            return $cache->get(self::CACHE_KEY);
        }

        $prices = $this->fetchPricesFromApi($total);
        $cache->put(self::CACHE_KEY, $prices, self::CACHE_TTL_MINUTES);

        return $prices;
    }

    /**
     * @param int $total
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchPricesFromApi($total = 500):array
    {
        $start = 1;
        $limit = 100;
        while ($start < $total) {
            $tickerPrices = $this->tickerApi->getTicker($start, $limit);
            foreach ($tickerPrices->data as $ticker) {
                $this->marketPrices[$ticker->symbol] = $ticker->quotes->USD->price;
            }
            $start += $limit;
        }

        return $this->marketPrices;
    }
}
