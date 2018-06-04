<?php

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\Exchanges\Struct\BalanceInterface;
use Lei\Bitracker\Exchanges\Struct\Currency;

/**
 * Class Portfolio
 * @package Lei\Bitracker\Http\ViewObjects
 */
class Portfolio
{
    /** @var float $sum */
    public $sum = 0;

    /** @var array $assets */
    public $assets = [];

    /**
     * @param BalanceInterface $balance
     * @return $this
     */
    public function process(BalanceInterface $balance): Portfolio
    {
        $this->sum += (float) $balance->getSum();
        foreach ($balance->getBalance() as $balanceDetail) {
            if (array_key_exists($balanceDetail->asset, $this->assets) === false) {
                $currency = new Currency();
                $currency->usd = $balanceDetail->usd;
                $currency->amount = $balanceDetail->amount;
            } else {
                $currency = $this->assets[$balanceDetail->asset];
                $currency->usd += $balanceDetail->usd;
                $currency->amount += $balanceDetail->amount;
            }
            $this->assets[$balanceDetail->asset] = $currency;
        }
        uasort($this->assets, function ($a, $b) {
            return $b->usd <=> $a->usd;
        });

        return $this;
    }
}
