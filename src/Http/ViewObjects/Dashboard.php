<?php

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\Exchanges\Struct\BalanceInterface;
use Lei\Bitracker\Exchanges\Transformer\TransformerInterface;
use PhpParser\Node\Stmt\Label;

/**
 * Class Dashboard
 * @package Lei\Bitracker\Http\ViewObjects
 */
class Dashboard
{
    /** @var MarketPrice  */
    protected $marketPrice;

    /** @var Transformer $transformer */
    protected $transformer;

    /** @var Portfolio $portfolio */
    public $portfolio;

    /** @var Exchange $exchange */
    public $exchange;

    /** @var LabelFormatter $labelFormatter */
    protected $labelFormatter;

    /**
     * Dashboard constructor.
     * @param MarketPrice $marketPrice
     * @param Portfolio $portfolio
     * @param Exchange $exchange
     * @param Transformer $transformer
     * @param LabelFormatter $labelFormatter
     */
    public function __construct(
        MarketPrice $marketPrice,
        Portfolio $portfolio,
        Exchange $exchange,
        Transformer $transformer,
        LabelFormatter $labelFormatter
    ) {
        $this->marketPrice = $marketPrice;
        $this->portfolio = $portfolio;
        $this->exchange = $exchange;
        $this->transformer = $transformer;
        $this->labelFormatter = $labelFormatter;
    }

    /**
     * @return Dashboard
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    public function getDashboard(): Dashboard
    {
        if (empty($this->transformer->transformers)) {
            throw new \Exception('no active transformers');
        }

        $prices = $this->marketPrice->fetchPrices();
        /** @var TransformerInterface $transformer */
        foreach ($this->transformer->transformers as $transformer) {
            /** @var BalanceInterface $balance */
            $balance = $transformer->transform($prices);
            $balance = $this->labelFormatter->format($balance);
            $this->exchange->addAccounts($balance);
            $this->portfolio->process($balance);
        }

        return $this;
    }
}
