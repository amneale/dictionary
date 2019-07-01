<?php

namespace spec\Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Generator\Generator;
use PhpSpec\ObjectBehavior;
use Webmozart\Assert\Assert;

class ShuffleWordGeneratorSpec extends ObjectBehavior
{
    private const STRINGS = ['foo', 'bar', 'baz'];

    /**
     * @var Dictionary
     */
    private $dictionary;

    public function let(): void
    {
        $this->dictionary = new Dictionary(...self::STRINGS);

        $this->beConstructedWith($this->dictionary);
    }

    public function it_is_a_generator(): void
    {
        $this->shouldImplement(Generator::class);
    }

    public function it_generates_each_string(): void
    {
        $strings = [
            $this->getNext()->getWrappedObject(),
            $this->getNext()->getWrappedObject(),
            $this->getNext()->getWrappedObject(),
        ];

        Assert::eq(
            $this->sort($strings),
            $this->sort(self::STRINGS),
            sprintf(
                '%s expected to have same values as %s, but it does not.',
                json_encode($strings),
                json_encode(self::STRINGS)
            )
        );
    }

    public function it_keeps_generating_strings_after_all_strings_generated(): void
    {
        $count = count(self::STRINGS) + 1;

        for ($i = 0; $i < $count; $i++) {
            $this->getNext()->shouldBeString();
        }
    }

    /**
     * @param array $array
     *
     * @return array
     */
    private function sort(array $array): array
    {
        sort($array);

        return $array;
    }

}
