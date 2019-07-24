<?php

declare(strict_types=1);

namespace Lexicon\Loader;

use Lexicon\Dictionary;

class FileLoader implements Loader
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @var string
     */
    private $delimiter;

    /**
     * @param string $basePath
     * @param string $delimiter
     */
    public function __construct(string $basePath = '', string $delimiter = "\n")
    {
        $this->basePath = $basePath;
        $this->delimiter = $delimiter;
    }

    /**
     * @inheritDoc
     */
    public function load(string $resource): Dictionary
    {
        $contents = file_get_contents($this->basePath . $resource);
        $words = explode($this->delimiter, $contents);

        return new Dictionary(...$words);
    }
}
