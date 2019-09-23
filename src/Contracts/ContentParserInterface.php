<?php

namespace ContentParser\Contracts;

interface ContentParserInterface
{

    /**
     * Return an instance of itself from a the given file contents and file extension
     *
     * @param string $file_contents
     * @param string|null $file_extension
     * @return ContentParserInterface
     */
    public static function forString(string $file_contents, string $file_extension = null): ContentParserInterface;

    /**
     * Parse the given data and return it as a string
     *
     * @return string
     */
    public function parse(): string;
}
