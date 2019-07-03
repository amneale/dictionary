<?php

namespace spec\Lexicon\Dictionary\Loader;

use Lexicon\Dictionary\Dictionary;
use Lexicon\Dictionary\Loader\Loader;
use PhpSpec\ObjectBehavior;
use Vfs\FileSystem;

class TxtFileLoaderSpec extends ObjectBehavior
{
    private const DATA = <<<EOD
Foo
Bar
Baz
EOD;

    /**
     * @var FileSystem
     */
    private $filesystem;

    public function it_is_a_loader(): void
    {
        $this->shouldImplement(Loader::class);
    }

    public function it_loads_strings_from_a_txt_file(): void
    {
        $filename = $this->writeToFile(self::DATA);
        $dictionary = $this->load($filename);

        $dictionary->shouldBeAnInstanceOf(Dictionary::class);
        $dictionary->shouldHaveCount(3);
        $dictionary->toArray()->shouldEqual(['Foo', 'Bar', 'Baz']);
    }

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
