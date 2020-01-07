<?php

declare(strict_types=1);

namespace Dictionary\Loader;

use Dictionary\Dictionary;

final class FileLoader implements Loader
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
     * @param string $resource
     * @param string $delimiter
     *
     * @return Dictionary
     */
    public static function fromFile(string $resource, string $delimiter = "\n"): Dictionary
    {
        $loader = new static('', $delimiter);

        return $loader->load($resource);
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
