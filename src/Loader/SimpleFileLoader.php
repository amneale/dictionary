<?php

declare(strict_types=1);

namespace Dictionary\Loader;

use Dictionary\Dictionary;

final class SimpleFileLoader extends FileLoader
{
    /**
     * @var string
     */
    private $delimiter;

    public function __construct(string $basePath = '', string $delimiter = "\n")
    {
        $this->delimiter = $delimiter;

        parent::__construct($basePath);
    }

    public static function fromFile(string $resource, string $delimiter = "\n"): Dictionary
    {
        $loader = new static('', $delimiter);

        return $loader->load($resource);
    }

    protected function getPath(string $resource): string
    {
        return $this->basePath . $resource;
    }

    /**
     * @inheritDoc
     */
    protected function getWords(string $contents): array
    {
        return explode($this->delimiter, $contents);
    }
}
