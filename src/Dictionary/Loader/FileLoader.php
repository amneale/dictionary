<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;

class FileLoader implements Loader
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
