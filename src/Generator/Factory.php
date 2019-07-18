<?php

declare(strict_types=1);

namespace Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Dictionary\Loader\Loader;

trait Factory
{
    /**
     * @param string[] $words
     *
     * @return Generator
     */
    public static function fromWords(string ...$words): Generator
    {
        return self::create(new Dictionary(...$words));
    }

    /**
     * @param Loader $loader
     * @param string $resource
     *
     * @return Generator
     */
    public static function fromLoader(Loader $loader, string $resource): Generator
    {
        return self::create($loader->load($resource));
    }

    /**
     * @param Dictionary $dictionary
     *
     * @return Generator
     */
    private static function create(Dictionary $dictionary): Generator
    {
        $className = static::class;

        return new $className($dictionary);
    }
}
