<?php

namespace Lei\Bitracker\Exchanges\Struct;

/**
 * Class BalanceStruct
 * @package Lei\Bitracker\Exchanges\Struct
 */
abstract class BalanceStruct implements BalanceInterface
{
    /**
     * @return string
     */
    abstract public function getName():string;

    /** @var array $balance */
    protected $balance;

    /** @var string $sum */
    protected $sum;

    /**
     * @return array
     */
    public function getBalance(): array
    {
        return $this->balance;
    }

    /**
     * @param array $balance
     */
    public function setBalance(array $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getSum():string
    {
        return $this->sum;
    }

    /**
     * @param string $sum
     */
    public function setSum($sum):void
    {
        $this->sum = $sum;
    }
}
