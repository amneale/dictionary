<?php

namespace Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;

class TxtFileLoader implements Loader
{
    /**
     * @inheritDoc
     */
    public function load(string $resource): Dictionary
    {
        $contents = file_get_contents($resource);
        $words = explode("\n", $contents);

        return new Dictionary(...$words);
    }
}
