<?php

declare(strict_types=1);

namespace spec\Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Dictionary\Loader\Loader;
use PhpSpec\ObjectBehavior;
use Vfs\FileSystem;

class FileLoaderSpec extends ObjectBehavior
{
    /**
     * @var FileSystem
     */
    private $filesystem;

    public function it_is_a_loader(): void
    {
        $this->shouldImplement(Loader::class);
    }

    public function it_loads_strings_from_a_line_separated_file(): void
    {
        $filename = $this->writeToFile("Foo\nBar\nBaz");

        $dictionary = $this->load($filename);
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    public function it_loads_strings_from_a_comma_separated_file(): void
    {
        $filename = $this->writeToFile('Foo,Bar,Baz');
        $this->setDelimiter(',');

        $dictionary = $this->load($filename);
        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

    /**
     * @param string $data
     *
     * @return string
     */
    private function writeToFile(string $data): string
    {
        if (null === $this->filesystem) {
            $this->filesystem = FileSystem::factory('vfs://');
            $this->filesystem->mount();
        }

        $filename = 'vfs://' . uniqid('file', true) . 'txt';
        file_put_contents($filename, $data);

        return $filename;
    }
}
