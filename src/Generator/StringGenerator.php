<?php

declare(strict_types=1);

namespace Lexicon\Generator;

use Lexicon\Dictionary\Reader\Reader;

class StringGenerator
{
    /**
     * @var Reader[]
     */
    private $readers;

    /**
     * @var string
     */
    private $separator = ' ';

    /**
     * @param Reader[] $readers
     */
    public function __construct(Reader ...$readers)
    {
        $this->readers = $readers;
    }

    /**
     * @return string
     */
    public function generateString(): string
    {
        $items = [];

        foreach ($this->readers as $reader) {
            $items[] = $reader->getNext();
        }

        return implode($this->separator, $items);
    }

    /**
     * @param int $count
     *
     * @return string[]
     */
    public function generateStrings(int $count): array
    {
        $items = [];

        for ($i = 0; $i < $count; ++$i) {
            $items[] = $this->generateString();
        }

        return $items;
    }

    /**
     * @param string $separator
     */
    public function setSeparator(string $separator): void
    {
        $this->separator = $separator;
    }
}
