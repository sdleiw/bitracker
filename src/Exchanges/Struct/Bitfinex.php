<?php

namespace Lei\Bitracker\Exchanges\Struct;

/**
 * Class Bitfinex
 * @package Lei\Bitracker\Exchanges\Struct
 */
class Bitfinex extends BalanceStruct
{
    /**
     * @return string
     */
    public function getName():string
    {
        return 'bitfinex';
    }
}
