<?php

namespace Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;

class RandomWordGenerator implements Generator
{
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
     * @throws \Exception
     */
    public function getNext(): string
    {
        $words = iterator_to_array($this->dictionary);

        return $words[random_int(0, count($words) - 1)];
    }
}
