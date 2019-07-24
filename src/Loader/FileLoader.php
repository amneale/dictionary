<?php

declare(strict_types=1);

namespace Lexicon\Loader;

use Lexicon\Dictionary;

class FileLoader implements Loader
{
    /**
     * @inheritDoc
     */
    public function load(string $resource, string $delimiter = "\n"): Dictionary
    {
        $contents = file_get_contents($resource);
        $words = explode($delimiter, $contents);

        return new Dictionary(...$words);
    }
}
