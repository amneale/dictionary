<?php

declare(strict_types=1);

namespace Dictionary\Loader;

use Dictionary\Dictionary;

abstract class FileLoader implements Loader
{
    /**
     * @var string
     */
    protected $basePath;

    public function __construct(string $basePath = '')
    {
        $this->basePath = $basePath;
    }

    final public function load(string $resource): Dictionary
    {
        $contents = file_get_contents($this->getPath($resource));
        $words = $this->getWords($contents);

        return new Dictionary(...$words);
    }

    abstract protected function getPath(string $resource): string;

    /**
     * @return string[]
     */
    abstract protected function getWords(string $contents): array;
}
