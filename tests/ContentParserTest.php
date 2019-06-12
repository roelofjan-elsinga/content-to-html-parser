<?php

namespace Tests\Feature;

use ContentParser\ContentParser;
use ContentParser\Parsers\HtmlParser;
use ContentParser\Parsers\MarkdownParser;
use ContentParser\Parsers\TxtParser;
use PHPUnit\Framework\TestCase;

class ContentParserTest extends TestCase
{
    public function testHtmlParserIsSelectedForFile()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.html'));

        $this->assertSame(HtmlParser::class, get_class($parser->getParser()));
    }

    public function testHtmlParserIsSelectedForString()
    {
        $parser = ContentParser::forString("This is some beautiful <strong>content</strong> to test the parser", 'html');

        $this->assertSame(HtmlParser::class, get_class($parser->getParser()));
    }

    public function testMarkdownParserIsSelectedForFile()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.md'));

        $this->assertSame(MarkdownParser::class, get_class($parser->getParser()));
    }

    public function testMarkdownParserIsSelectedForString()
    {
        $parser = ContentParser::forString("This is some beautiful **content** to test the parser", 'md');

        $this->assertSame(MarkdownParser::class, get_class($parser->getParser()));
    }

    public function testTxtParserIsSelectedForFile()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.txt'));

        $this->assertSame(TxtParser::class, get_class($parser->getParser()));
    }

    public function testTxtParserIsSelectedForString()
    {
        $parser = ContentParser::forString("This is some beautiful content to test the parser", 'txt');

        $this->assertSame(TxtParser::class, get_class($parser->getParser()));
    }

    public function testDefaultParserIsTxtForFilesWithoutExtension()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content'));

        $this->assertSame(TxtParser::class, get_class($parser->getParser()));
    }

    public function testDefaultParserIsTxtForStringWhenNoExtensionSpecified()
    {
        $parser = ContentParser::forString("This is some beautiful content to test the parser");

        $this->assertSame(TxtParser::class, get_class($parser->getParser()));
    }

    public function testExceptionIsThrownWhenInvalidFilePathGiven()
    {
        $this->expectException(\Exception::class);

        ContentParser::forFile(realpath('tests/TestFiles/contents.docx'));
    }

    public function testHtmlFileIsParsedAsHtml()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.html'));

        $this->assertSame(
            "This is some beautiful <strong>content</strong> to test the parser",
            $parser->parse()
        );
    }

    public function testMarkdownFileIsParsedAsHtml()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.md'));

        $this->assertSame(
            "<p>This is some beautiful <strong>content</strong> to test the parser</p>",
            $parser->parse()
        );
    }

    public function testTxtFileIsParsedAsHtml()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content.txt'));

        $this->assertSame(
            "This is some beautiful content to test the parser",
            $parser->parse()
        );
    }

    public function testFileWithoutExtensionIsParsedAsHtml()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content'));

        $this->assertSame(
            "This is some beautiful content to test the parser",
            $parser->parse()
        );
    }

    public function testTxtStringWithLineBreaksIsParsedAsHtml()
    {
        $parser = ContentParser::forFile(realpath('tests/TestFiles/content-with-line-breaks'));

        $this->assertTrue(strpos($parser->parse(), '<br />') !== false);
    }
}
