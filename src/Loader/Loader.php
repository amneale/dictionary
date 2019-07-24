<?php

declare(strict_types=1);

namespace Lexicon\Loader;

use Lexicon\Dictionary;

interface Loader
{
    /**
     * @param string $resource
     *
     * @return Dictionary
     */
    public function load(string $resource): Dictionary;
}
