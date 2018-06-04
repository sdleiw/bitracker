<?php
declare(strict_types=1);

/**
 * Created by lei
 */

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\Exchanges\Struct\BalanceInterface;

class LabelFormatter
{
    /**
     * @param BalanceInterface $balance
     * @return BalanceInterface
     */
    public function format(BalanceInterface $balance)
    {
        $balances = $balance->getBalance();
        $balances =  array_map([$this, 'convert'], $balances);
        $balance->setBalance($balances);

        return $balance;
    }

    /**
     * @param $item
     * @return mixed
     */
    public function convert($item)
    {
        $rules = [
            'IOT' => 'IOTA',
        ];

        if (array_key_exists($item->asset, $rules)) {
            $item->asset = $rules[$item->asset];
        }

        return $item;
    }
}
