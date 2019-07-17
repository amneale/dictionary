<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;

class FileLoader implements Loader
{
    /**
     * @var string
     */
    private $delimiter = "\n";

    /**
     * @inheritDoc
     */
    public function load(string $resource): Dictionary
    {
        $contents = file_get_contents($resource);
        $words = explode($this->delimiter, $contents);

        return new Dictionary(...$words);
    }

    /**
     * @param string $delimiter
     */
    public function setDelimiter(string $delimiter): void
    {
        $this->delimiter = $delimiter;
    }
}
