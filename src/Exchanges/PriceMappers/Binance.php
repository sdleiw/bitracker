<?php

namespace Lei\Bitracker\Exchanges\PriceMappers;

/**
 * Class Bitfinex
 * @package Lei\Bitracker\Exchanges\PriceMappers
 */
class Binance implements MapperInterface
{
    /**
     * @return array
     */
    public function getMapper(): array
    {
        return [
            'IOTA' => 'miota',
        ];
    }
}
