# Content to HTML Parser

[![Build status](https://travis-ci.com/roelofjan-elsinga/content-to-html-parser.svg)](https://travis-ci.com/roelofjan-elsinga/content-to-html-parser)
[![StyleCI Status](https://github.styleci.io/repos/191525268/shield)](https://github.styleci.io/repos/191525268)
[![Code coverage](https://codecov.io/gh/roelofjan-elsinga/content-to-html-parser/branch/master/graph/badge.svg)](https://codecov.io/gh/roelofjan-elsinga/content-to-html-parser)
[![Total Downloads](https://poser.pugx.org/roelofjan-elsinga/content-to-html-parser/downloads)](https://packagist.org/packages/roelofjan-elsinga/content-to-html-parser)
[![Latest Stable Version](https://poser.pugx.org/roelofjan-elsinga/content-to-html-parser/v/stable)](https://packagist.org/packages/roelofjan-elsinga/content-to-html-parser)
[![License](https://poser.pugx.org/roelofjan-elsinga/content-to-html-parser/license)](https://packagist.org/packages/roelofjan-elsinga/content-to-html-parser)

This package converts content from strings or files to HTML strings to be rendered on a page.

## Installation

You can include this package through Composer using:

```bash
composer require roelofjan-elsinga/content-to-html-parser
```

## Usage

```php
use ContentParser\ContentParser;

$parser = ContentParser::forFile('/absolute/path/to/file.txt');

// OR

$parse_string = 'This is some beautiful text';

$parser = ContentParser::forString($parse_string, 'txt');

print $parser->parse(); // This is an HTML string

```

## Available parsers

There are currently three parsers included:
- **HTML to HTML**: This doesn't modify the string
- **Markdown to HTML**: This parses Markdown to HTML strings
- **TXT to HTML**: This parses plain text to usable HTML markup through nl2br()

## Available methods

This package comes with two named constructors:
- ``public static function forFile(string $file_path): ContentParserInterface``
- ``public static function forString(string $file_contents, string $file_extension = null): ContentParserInterface``

You can parse the strings and get the resulting HTML string by calling: 
``public function parse(): string``

If you want to get the underlying parser, you can use: 
``public function getParser(): ContentParserInterface``

## Testing

You can run the included tests by running ``./vendor/bin/phpunit`` in your terminal.

## Contributions

If you want to contribute you can add additional ContentParsers or improve the current parsers.
