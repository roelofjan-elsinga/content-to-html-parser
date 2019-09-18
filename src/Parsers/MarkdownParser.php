<?php

namespace ContentParser\Parsers;

use ContentParser\Contracts\AbstractContentParser;
use ContentParser\Contracts\ContentParserInterface;

class MarkdownParser extends AbstractContentParser implements ContentParserInterface
{

    /**
     * Parse the given data and return it as a string
     *
     * @return string
     */
    public function parse(): string
    {
        return (new \Parsedown())->parse($this->file_contents);
    }
}
