<?php

declare(strict_types=1);

namespace spec\Lexicon\Generator;

use Lexicon\Generator\Generator;
use PhpSpec\ObjectBehavior;

class MultiWordGeneratorSpec extends ObjectBehavior
{
    public function let(Generator $generator1, Generator $generator2, Generator $generator3): void
    {
        $generator1->getNext()->willReturn('Foo');
        $generator2->getNext()->willReturn('Bar');
        $generator3->getNext()->willReturn('Baz');

        $this->beConstructedWith($generator1, $generator2, $generator3);
    }

    public function it_is_a_generator(): void
    {
        $this->shouldImplement(Generator::class);
    }

    public function it_generates_multiple_words(): void
    {
        $this->getNext()->shouldBe('Foo Bar Baz');
    }

    public function it_can_use_a_custom_separator(): void
    {
        $this->setSeparator('+');
        $this->getNext()->shouldBe('Foo+Bar+Baz');
    }
}
