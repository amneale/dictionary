<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

use Lexicon\Dictionary\Dictionary;

class RandomReader implements Reader
{
    /**
     * @inheritDoc
     */
    public function read(Dictionary $dictionary): string
    {
        $words = $dictionary->toArray();

        return $words[random_int(0, count($words) - 1)];
    }
}
