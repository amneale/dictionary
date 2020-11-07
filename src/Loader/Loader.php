<?php

declare(strict_types=1);

namespace Dictionary\Loader;

use Dictionary\Dictionary;

interface Loader
{
    public function load(string $resource): Dictionary;
}
