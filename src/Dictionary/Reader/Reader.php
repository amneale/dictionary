<?php

declare(strict_types=1);

namespace Lexicon\Dictionary\Reader;

interface Reader
{
    public function getNext(): string;
}
