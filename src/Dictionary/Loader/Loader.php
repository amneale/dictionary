<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;

interface Loader
{
    /**
     * @param string $resource
     *
     * @return Dictionary
     */
    public function load(string $resource): Dictionary;
}
