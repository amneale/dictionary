<?php

declare(strict_types=1);

namespace spec\Lexicon\Dictionary\Reader;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Dictionary\Loader\Loader;
use Lexicon\Dictionary\Reader\Reader;
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

        $this->beConstructedWith($this->dictionary);
    }

    public function it_is_a_reader(): void
    {
        $this->shouldImplement(Reader::class);
    }

    public function it_can_be_created_from_words(): void
    {
        $this->beConstructedThrough('fromWords', self::STRINGS);
        $this->shouldImplement(Reader::class);
    }

    public function it_can_be_created_from_a_loader(Loader $loader): void
    {
        $loader->load('foo/bar/baz')->willReturn(new Dictionary(...self::STRINGS));

        $this->beConstructedThrough('fromLoader', [$loader, 'foo/bar/baz']);
        $this->shouldImplement(Reader::class);
    }

    public function it_reads_a_random_string(): void
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
