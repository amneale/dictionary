<?php

declare(strict_types=1);

namespace Lexicon\Generator;

interface Generator
{
    public function getNext(): string;
}
