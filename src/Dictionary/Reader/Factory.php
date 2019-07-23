<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Dictionary\Loader\Loader;

trait Factory
{
    /**
     * @param string[] $words
     *
     * @return Reader
     */
    public static function fromWords(string ...$words): Reader
    {
        return self::create(new Dictionary(...$words));
    }

    /**
     * @param Loader $loader
     * @param string $resource
     *
     * @return Reader
     */
    public static function fromLoader(Loader $loader, string $resource): Reader
    {
        return self::create($loader->load($resource));
    }

    /**
     * @param Dictionary $dictionary
     *
     * @return Reader
     */
    private static function create(Dictionary $dictionary): Reader
    {
        $className = static::class;

        return new $className($dictionary);
    }
}
