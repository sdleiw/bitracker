<?php

namespace Lei\Bitracker\Exchanges\Transformer;

use Lei\Bitracker\Exchanges\Struct\BalanceInterface;

/**
 * Interface TransformerInterface
 * @package Lei\Bitracker\Exchanges\Transformer
 */
interface TransformerInterface
{
    /**
     * @param array $prices
     * @return BalanceInterface
     */
    public function transform(array $prices): BalanceInterface;
}
