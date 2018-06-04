<?php

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\Exchanges\Struct\BalanceInterface;

/**
 * Class Exchange
 * @package Lei\Bitracker\Http\ViewObjects
 */
class Exchange
{
    /** @var array $exchanges */
    public $exchanges;

    /**
     * @param BalanceInterface $balance
     */
    public function addAccounts(BalanceInterface $balance): void
    {
        $sortedBalance = clone($balance);
        $balances = $balance->getBalance();
        uasort($balances, function ($a, $b) {
            return $b->usd <=> $a->usd;
        });
        $sortedBalance->setBalance($balances);

        $this->exchanges[$balance->getName()] = $sortedBalance;
    }
}
