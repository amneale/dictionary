<?php

namespace spec\Lexicon\Generator;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Generator\Generator;
use PhpSpec\Exception\Example\FailureException;
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

    public function it_generates_a_random_string(): void
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
                if (!in_array($subject, $array, true)) {
                    throw new FailureException(
                        sprintf(
                            '"%s" expected to be in array ["%s"], but it is not.',
                            $subject,
                            implode('", "', $array)
                        )
                    );
                }

                return true;
            },
        ];
    }
}
