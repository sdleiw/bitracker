<?php

namespace Lei\Bitracker\Exchanges\Struct;

/**
 * Class HitBtc
 * @package Lei\Bitracker\Exchanges\Struct
 */
class HitBtc extends BalanceStruct
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'hitbtc';
    }
}
