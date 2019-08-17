<?php

declare(strict_types=1);

namespace Dictionary\Reader;

use Dictionary\Dictionary;

interface Reader
{
    /**
     * @param Dictionary $dictionary
     *
     * @return string
     */
    public function read(Dictionary $dictionary): string;
}
