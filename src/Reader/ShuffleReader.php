<?php

declare(strict_types=1);

namespace Dictionary\Reader;

use Dictionary\Dictionary;

final class ShuffleReader implements Reader
{
    /**
     * @var Dictionary[]
     */
    private $dictionaries = [];

    /**
     * @var int[]
     */
    private $indexes = [];

    public function read(Dictionary $dictionary): string
    {
        $key = spl_object_id($dictionary);

        if ($this->needsShuffling($key)) {
            $this->shuffle($dictionary, $key);
        }

        $words = $this->dictionaries[$key]->toArray();

        return $words[$this->indexes[$key]++];
    }

    private function needsShuffling(int $key): bool
    {
        if (!isset($this->dictionaries[$key], $this->indexes[$key])) {
            return true;
        }

        return $this->indexes[$key] === count($this->dictionaries[$key]);
    }

    private function shuffle(Dictionary $dictionary, int $key): void
    {
        $dictionaryArray = $dictionary->toArray();
        shuffle($dictionaryArray);

        $this->dictionaries[$key] = new Dictionary(...$dictionaryArray);
        $this->indexes[$key] = 0;
    }
}
