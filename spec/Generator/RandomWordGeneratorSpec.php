<?php

namespace spec\Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Generator\Generator;
use PhpSpec\ObjectBehavior;

class RandomWordGeneratorSpec extends ObjectBehavior
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

    public function it_generates_random_strings(): void
    {
        $string = $this->getNext();

        $string->shouldBeString();
        $string->shouldBeInArray(self::STRINGS);
    }

    /**
     * @return array
     */
    public function getMatchers(): array
    {
        return [
            'beInArray' => static function($subject, $array) {
                return in_array($subject, $array, true);
            },
        ];
    }


}
