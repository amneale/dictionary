<?php

declare(strict_types=1);

namespace spec\Dictionary\Reader;

use Dictionary\Dictionary;
use Dictionary\Reader\Reader;
use PhpSpec\ObjectBehavior;
use Webmozart\Assert\Assert;

class ShuffleReaderSpec extends ObjectBehavior
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

    public function it_reads_each_string(): void
    {
        $strings = [
            $this->read($this->dictionary)->getWrappedObject(),
            $this->read($this->dictionary)->getWrappedObject(),
            $this->read($this->dictionary)->getWrappedObject(),
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

        for ($i = 0; $i < $count; ++$i) {
            $this->read($this->dictionary)->shouldBeString();
        }
    }

    private function sort(array $array): array
    {
        sort($array);

        return $array;
    }
}
