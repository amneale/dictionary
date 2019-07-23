<?php

declare(strict_types=1);

namespace spec\Lexicon\Reader;

use Lexicon\Dictionary;
use Lexicon\Reader\Reader;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class RandomReaderSpec extends ObjectBehavior
{
    private const STRINGS = ['foo', 'bar', 'baz'];

    /**
     * @var Dictionary
     */
    private $dictionary;

    public function let(): void
    {
        $this->dictionary = new Dictionary(...self::STRINGS);
    }

    public function it_is_a_reader(): void
    {
        $this->shouldImplement(Reader::class);
    }

    public function it_reads_a_random_string(): void
    {
        $string = $this->read($this->dictionary);
        $string->shouldBeString();
        $string->shouldBeInArray(self::STRINGS);
    }

    /**
     * @return array
     */
    public function getMatchers(): array
    {
        return [
            'beInArray' => static function ($subject, $array) {
                if (!in_array($subject, $array, true)) {
                    throw new FailureException(
                        sprintf(
                            '"%s" expected to be in array %s, but it is not.',
                            $subject,
                            json_encode($array)
                        )
                    );
                }

                return true;
            },
        ];
    }
}
