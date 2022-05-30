<?php

declare(strict_types=1);

namespace spec\Dictionary\Loader;

use Dictionary\Dictionary;
use Dictionary\Loader\Loader;
use PhpSpec\ObjectBehavior;

class SimpleFileLoaderSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $csvFile;

    public function let(): void
    {
        $this->file = $this->writeToFile("Foo\nBar\nBaz");
        $this->csvFile = $this->writeToFile('Foo,Bar,Baz');
    }

    public function it_is_a_loader(): void
    {
        $this->shouldImplement(Loader::class);
    }

    public function it_loads_strings_from_a_line_separated_file(): void
    {
        $dictionary = $this->load($this->file);
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    public function it_loads_strings_from_a_comma_separated_file(): void
    {
        $this->beConstructedWith('', ',');

        $dictionary = $this->load($this->csvFile);
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    public function it_statically_loads_strings_from_a_line_separated_file(): void
    {
        $dictionary = $this::fromFile($this->file);
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    public function it_statically_loads_strings_from_a_comma_separated_file(): void
    {
        $dictionary = $this::fromFile($this->csvFile, ',');
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    private function writeToFile(string $data): string
    {
        $filename = tempnam(sys_get_temp_dir(), uniqid('file', true));
        file_put_contents($filename, $data);

        return $filename;
    }
}
