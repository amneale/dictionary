<?php

declare(strict_types=1);

namespace Dictionary\Reader;

use Dictionary\Dictionary;

interface Reader
{
    public function read(Dictionary $dictionary): string;
}
