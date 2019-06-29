<?php

namespace Lexicon\Dictionary;

final class Dictionary implements \IteratorAggregate
{
    /**
     * @var string[]
     */
    private $words;

    /**
     * @param string ...$words
     */
    public function __construct(string ...$words)
    {
        $this->words = $words;
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->words);
    }
}