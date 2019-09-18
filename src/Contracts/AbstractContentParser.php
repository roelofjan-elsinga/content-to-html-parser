<?php

namespace ContentParser\Contracts;

abstract class AbstractContentParser implements ContentParserInterface
{

    /**@var string*/
    protected $file_contents;

    /**@var string*/
    protected $file_extension;

    protected function __construct(string $file_contents, string $file_extension)
    {
        $this->file_contents = $file_contents;
        $this->file_extension = $file_extension;
    }

    /**
     * Return an instance of itself from a the given file contents and file extension
     *
     * @param string $file_contents
     * @param string $file_extension
     * @return ContentParser
     */
    public static function forString(string $file_contents, string $file_extension = null): ContentParserInterface
    {
        $file_extension = $file_extension ?? 'txt';

        return new static($file_contents, $file_extension);
    }
}
