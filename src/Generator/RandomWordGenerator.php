<?php

declare(strict_types=1);

namespace Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;

class RandomWordGenerator implements Generator
{
    use Factory;

    /**
     * @var Dictionary
     */
    private $dictionary;

    /**
     * @param Dictionary $dictionary
     */
    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @inheritDoc
     */
    public function getNext(): string
    {
        $words = $this->dictionary->toArray();

        return $words[random_int(0, count($words) - 1)];
    }
}
