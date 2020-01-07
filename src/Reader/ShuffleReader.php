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

    /**
     * @inheritDoc
     */
    public function read(Dictionary $dictionary): string
    {
        if ($this->needsShuffling($dictionary)) {
            $this->shuffle($dictionary);
        }

        $key = $this->getDictionaryKey($dictionary);
        $words = $this->dictionaries[$key]->toArray();

        return $words[$this->indexes[$key]++];
    }

    /**
     * @param Dictionary $dictionary
     *
     * @return bool
     */
    private function needsShuffling(Dictionary $dictionary): bool
    {
        $key = $this->getDictionaryKey($dictionary);

        if (!isset($this->dictionaries[$key], $this->indexes[$key])) {
            return true;
        }

        return $this->indexes[$key] === count($this->dictionaries[$key]);
    }

    /**
     * @param Dictionary $dictionary
     */
    private function shuffle(Dictionary $dictionary): void
    {
        $key = $this->getDictionaryKey($dictionary);

        $dictionaryArray = $dictionary->toArray();
        shuffle($dictionaryArray);

        $this->dictionaries[$key] = new Dictionary(...$dictionaryArray);
        $this->indexes[$key] = 0;
    }

    /**
     * @param Dictionary $dictionary
     *
     * @return string
     */
    private function getDictionaryKey(Dictionary $dictionary): string
    {
        return md5(serialize($dictionary));
    }
}
