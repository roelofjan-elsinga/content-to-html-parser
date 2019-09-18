<?php

namespace ContentParser\Parsers;

use ContentParser\Contracts\AbstractContentParser;
use ContentParser\Contracts\ContentParserInterface;

class TxtParser extends AbstractContentParser implements ContentParserInterface
{

    /**
     * Parse the given data and return it as a string
     *
     * @return string
     */
    public function parse(): string
    {
        return nl2br($this->file_contents);
    }
}
