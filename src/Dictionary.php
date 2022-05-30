<?php

declare(strict_types=1);

namespace Dictionary;

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
    public function count(): int
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

    public function toArray(): array
    {
        return $this->words;
    }
}
