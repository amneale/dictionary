<?php

declare(strict_types=1);

namespace Dictionary\Reader;

use Dictionary\Dictionary;

final class RandomReader implements Reader
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
