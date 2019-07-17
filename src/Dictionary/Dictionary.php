<?php

declare(strict_types=1);

namespace Lexicon\Dictionary;

final class Dictionary implements \Countable, \IteratorAggregate
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
    public function count()
    {
        return count($this->words);
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->words);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->words;
    }
}
