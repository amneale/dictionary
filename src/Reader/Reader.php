<?php

declare(strict_types=1);

namespace Lexicon\Reader;

use Lexicon\Dictionary;

interface Reader
{
    /**
     * @param Dictionary $dictionary
     *
     * @return string
     */
    public function read(Dictionary $dictionary): string;
}
