<?php

namespace Lei\Bitracker\Exchanges\Struct;

/**
 * Class Binance
 * @package Lei\Bitracker\Exchanges\Struct
 */
class Binance extends BalanceStruct
{
    /**
     * @return string
     */
    public function getName():string
    {
        return 'binance';
    }
}
