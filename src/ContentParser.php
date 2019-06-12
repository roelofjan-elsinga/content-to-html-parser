<?php

namespace ContentParser;

use ContentParser\Contracts\AbstractContentParser;
use ContentParser\Contracts\ContentParserInterface;
use ContentParser\Parsers\HtmlParser;
use ContentParser\Parsers\MarkdownParser;
use ContentParser\Parsers\TxtParser;

class ContentParser extends AbstractContentParser implements ContentParserInterface
{

    /**@var ContentParserInterface*/
    private $parser;

    protected function __construct(string $file_contents, string $file_extension)
    {
        parent::__construct($file_contents, $file_extension);

        $this->parser = $this->parser($file_contents, $file_extension);
    }

    /**
     * Return an instance of itself from a given file_path
     *
     * @param string $file_path
     * @return ContentParser
     * @throws \Exception
     */
    public static function forFile(string $file_path): ContentParser
    {
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);

        if( ! file_exists($file_path) ) {
            throw new \Exception("File does not exist: {$file_path}");
        }

        $file_contents = file_get_contents($file_path);

        return new static($file_contents, $extension);
    }

    /**
     * Parse the given data and return it as a string
     *
     * @return string
     */
    public function parse(): string
    {
        return $this->parser->parse();
    }

    /**
     * Return a new instance of the parser based on the given file extension and file contents
     *
     * @param string $file_contents
     * @param string $file_extension
     * @return ContentParserInterface
     */
    private function parser(string $file_contents, string $file_extension): ContentParserInterface
    {
        $parser_mapping = $this->getParserMapping();

        $parser_class = $parser_mapping[$file_extension] ?? $this->getDefaultParser();

        return $parser_class::forString($file_contents, $file_extension);
    }

    /**
     * Get the selected parser instance
     *
     * @return ContentParserInterface
     */
    public function getParser(): ContentParserInterface
    {
        return $this->parser;
    }

    /**
     * Return the file extension mapping to the related content parser
     *
     * @return array
     */
    private function getParserMapping(): array
    {
        return [
            'md' => MarkdownParser::class,
            'html' => HtmlParser::class,
            'txt' => TxtParser::class
        ];
    }

    /**
     * Get the default content parser
     *
     * @return string
     */
    private function getDefaultParser(): string
    {
        return TxtParser::class;
    }
}