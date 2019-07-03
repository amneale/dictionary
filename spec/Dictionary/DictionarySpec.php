<?php

namespace spec\Lexicon\Dictionary;

use PhpSpec\ObjectBehavior;

class DictionarySpec extends ObjectBehavior
{
    private const STRINGS = ['foo', 'bar', 'baz'];

    public function let(): void
    {
        $this->beConstructedWith(...self::STRINGS);
    }

    public function it_is_countable(): void
    {
        $this->shouldImplement(\Countable::class);
        $this->shouldHaveCount(3);
    }

    public function it_is_iterable(): void
    {
        $this->shouldImplement(\Traversable::class);
        $this->shouldIterateAs(new \ArrayIterator(self::STRINGS));
    }

    public function it_returns_an_array_of_values(): void
    {
        $this->toArray()->shouldEqual(self::STRINGS);
    }
}
