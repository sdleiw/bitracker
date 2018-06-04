<?php
/**
 * Created by lei
 */

return [
    'binance' => [
        'active' => env('BINANCE_API_ACTIVE'),
        'api-key' => env('BINANCE_API_KEY'),
        'api-secret' => env('BINANCE_API_SECRET'),
        'transformer' => \Lei\Bitracker\Exchanges\Transformer\Binance::class,
    ],
    'bitfinex' => [
        'active' => env('BITFINEX_API_ACTIVE'),
        'api-key' => env('BITFINEX_API_KEY'),
        'api-secret' => env('BITFINEX_API_SECRET'),
        'transformer' => \Lei\Bitracker\Exchanges\Transformer\Bitfinex::class,
    ],
    'hitbtc' => [
        'active' => env('HITBTC_API_ACTIVE'),
        'api-key' => env('HITBTC_API_KEY'),
        'api-secret' => env('HITBTC_API_SECRET'),
        'transformer' => \Lei\Bitracker\Exchanges\Transformer\HitBtc::class,
    ],
];
