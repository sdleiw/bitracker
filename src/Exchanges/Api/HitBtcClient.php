<?php

namespace Lei\Bitracker\Exchanges\Api;

use GuzzleHttp\RequestOptions;

/**
 * Class HitBtcClient
 * @package Lei\Bitracker\Exchanges\Api
 */
class HitBtcClient implements ApiClientInterface
{
    /** @var HitBtcClient $client */
    protected $client;

    /** @var string $apiKey */
    protected $apiKey;

    /** @var string $apiSecret */
    protected $apiSecret;

    /**
     * Candlestick constructor.
     */
    public function __construct()
    {
        $this->apiKey = config('bitracker.hitbtc.api-key');
        $this->apiSecret = config('bitracker.hitbtc.api-secret');

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalances()
    {
        return $this->request('GET', '/account/balance');
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTradingBalances()
    {
        return $this->request('GET', '/trading/balance');
    }

    /**
     * @param $method
     * @param $url
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    protected function request($method, $url)
    {
        $response = $this->client->request($method, 'https://api.hitbtc.com/api/2' . $url, [
            RequestOptions::AUTH => [
                $this->apiKey,
                $this->apiSecret,
            ]
        ]);
        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        if ($statusCode < 200 || $statusCode > 299) {
            throw new \Exception($content);
        }

        return json_decode($content);
    }
}
