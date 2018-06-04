<?php

namespace Lei\Bitracker\Exchanges\PriceMappers;

/**
 * Interface MapperInterface
 * @package Lei\Bitracker\Exchanges\PriceMappers
 */
interface MapperInterface
{
    /**
     * @return array
     */
    public function getMapper(): array;
}
