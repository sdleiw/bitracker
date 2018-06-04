<?php

namespace Lei\Bitracker\CoinMarketCap;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;

/**
 * Class ApiClient
 * @package Lei\Bitracker\CoinMarketCap
 */
class ApiClient
{
    /** @var string $baseUrl */
    protected $baseUrl = 'https://api.coinmarketcap.com/v2/';

    /** @var Client $client */
    protected $client;

    /**
     * Coins constructor.
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->baseUrl]);
    }

    /**
     * @param $start
     * @param int $limit
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTicker($start, $limit = 100)
    {
        $query['start'] = $start;
        $query['limit'] = $limit;
        $response = $this->client->request('GET', 'ticker', [
            RequestOptions::QUERY => $query
        ]);

        return json_decode($response->getBody()->getContents());
    }
}
