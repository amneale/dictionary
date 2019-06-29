<?php

namespace Lexicon\Dictionary;

interface Loader
{
    /**
     * @param string $resource
     *
     * @return Dictionary
     */
    public function load(string $resource): Dictionary;
}