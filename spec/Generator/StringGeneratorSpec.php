<?php

declare(strict_types=1);

namespace spec\Lexicon\Generator;

use Lexicon\Dictionary\Reader\Reader;
use Lexicon\Generator\StringGenerator;
use PhpSpec\ObjectBehavior;

class StringGeneratorSpec extends ObjectBehavior
{
    public function let(Reader $reader): void
    {
        $reader->getNext()->willReturn('foo', 'bar', 'baz');

        $this->beConstructedWith($reader);
    }

    public function it_generates_a_string(): void
    {
        $this->generateString()->shouldReturn('foo');
        $this->generateString()->shouldReturn('bar');
        $this->generateString()->shouldReturn('baz');
    }

    public function it_generates_multiple_strings(): void
    {
        $this->generateStrings(3)->shouldReturn(['foo', 'bar', 'baz']);
    }

    public function it_can_use_multiple_readers(Reader $reader): void
    {
        $this->beConstructedWith($reader, $reader, $reader);
        $this->shouldImplement(StringGenerator::class);

        $this->generateString()->shouldReturn('foo bar baz');
        $this->generateStrings(3)->shouldReturn(['baz baz baz', 'baz baz baz', 'baz baz baz']);
    }

    public function it_can_use_a_custom_separator(Reader $reader): void
    {
        $this->beConstructedWith($reader, $reader, $reader);
        $this->shouldImplement(StringGenerator::class);
        $this->setSeparator(',');

        $this->generateString()->shouldReturn('foo,bar,baz');
    }
}
