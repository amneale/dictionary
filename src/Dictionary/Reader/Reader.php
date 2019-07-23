<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

use Lexicon\Dictionary\Dictionary;

interface Reader
{
    /**
     * @param Dictionary $dictionary
     *
     * @return string
     */
    public function read(Dictionary $dictionary): string;
}