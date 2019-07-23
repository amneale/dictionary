<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

use Lexicon\Dictionary\Dictionary;

class ShuffleReader implements Reader
{
    use Factory;

    /**
     * @var Dictionary
     */
    private $dictionary;

    /**
     * @var int|null
     */
    private $currentIndex;

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
        if (null === $this->currentIndex || $this->currentIndex === count($this->dictionary)) {
            $this->shuffle();
        }

        $words = $this->dictionary->toArray();

        return $words[$this->currentIndex++];
    }

    private function shuffle(): void
    {
        $dictionaryArray = $this->dictionary->toArray();
        shuffle($dictionaryArray);

        $this->dictionary = new Dictionary(...$dictionaryArray);
        $this->currentIndex = 0;
    }
}
