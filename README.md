# amneale/dictionary 
[![Build Status](https://img.shields.io/travis/com/amneale/dictionary?style=flat-square)](https://travis-ci.com/amneale/dictionary)
[![Code Quality](https://img.shields.io/codacy/grade/7539b9c3ee1c4582ae04c26a86b02a5e?style=flat-square)](https://www.codacy.com/app/amneale/dictionary)

## Install
Via Composer
``` bash
$ composer require amneale/dictionary
```

## Usage
Creating a dictionary from strings, and reading the content in a random, shuffled order:
``` php
$dictionary = new Dictionary('foo', 'bar', 'baz');

for ($i = 0; $i < count($dictionary); ++$i) {
    echo $this->read($dictionary) . "\n";
}
```

Loading a dictionary from a file:
``` php
$dictionary = Dictionary\Loader\SimpleFileLoader::fromFile('/foo/bar/baz.txt');
```

Loading a dictionary from a CSV file:
``` php
$dictionary = Dictionary\Loader\SimpleFileLoader::fromFile('/foo/bar/baz.csv', ',');
```

## Testing
To run automatic code-style fixer
``` bash
$ make fmt
```

To run all tests
``` bash
$ make test
```
