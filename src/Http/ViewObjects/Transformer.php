<?php

namespace Lei\Bitracker\Http\ViewObjects;

use Lei\Bitracker\Exchanges\Transformer\TransformerInterface;

/**
 * Class Transformer
 * @package Lei\Bitracker\Http\ViewObjects
 */
class Transformer
{
    /** @var array $transformers */
    public $transformers;

    /**
     * Transformer constructor.
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * init
     */
    protected function init(): void
    {
        foreach ($this->activeTransformers() as $transformer) {
            $this->addTransformers(app($transformer));
        }
    }

    /**
     * @param TransformerInterface $transformer
     */
    protected function addTransformers(TransformerInterface $transformer): void
    {
        $this->transformers[] = $transformer;
    }

    /**
     * @return array
     */
    protected function activeTransformers(): array
    {
        $activeTransformers = [];
        $config = config('bitracker');
        foreach ($config as $name => $exchange) {
            if ($exchange['active'] && $exchange['api-key'] && $exchange['api-secret']) {
                $activeTransformers[] = $exchange['transformer'];
            }
        }

        return $activeTransformers;
    }
}
