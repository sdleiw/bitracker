<?php

namespace Lei\Bitracker\Exchanges\PriceMappers;

/**
 * Class Bitfinex
 * @package Lei\Bitracker\Exchanges\PriceMappers
 */
class Bitfinex implements MapperInterface
{
    /**
     * @return array
     */
    public function getMapper(): array
    {
        return [
            'iot' => 'miota',
            'usd' => 'usdt'
        ];
    }
}
