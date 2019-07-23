<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

class MultiWordGenerator implements Reader
{
    /**
     * @var Generator[]
     */
    private $generators;

    /**
     * @var string
     */
    private $separator = ' ';

    /**
     * @param Generator ...$generators
     */
    public function __construct(Generator ...$generators)
    {
        $this->generators = $generators;
    }

    /**
     * @inheritDoc
     */
    public function getNext(): string
    {
        $items = [];

        foreach ($this->generators as $generator) {
            $items[] = $generator->getNext();
        }

        return implode($this->separator, $items);
    }

    /**
     * @param string $separator
     */
    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
    }
}
