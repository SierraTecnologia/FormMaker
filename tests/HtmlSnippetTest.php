<?php

use SierraTecnologia\FormMaker\Html\Div;
use SierraTecnologia\FormMaker\Html\HrTag;
use SierraTecnologia\FormMaker\Html\DivOpen;
use SierraTecnologia\FormMaker\Html\Heading;
use SierraTecnologia\FormMaker\Html\DivClose;
use SierraTecnologia\FormMaker\Html\HtmlSnippet;

class HtmlSnippetTest extends TestCase
{
    public function testHtmlSnippet()
    {
        $snippet = HtmlSnippet::make('<hr>');

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('<hr>', $snippet[$keys[0]]['content']);
    }

    public function testDivOpen()
    {
        $snippet = DivOpen::make(['class' => 'card']);

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('<div class="card">', $snippet[$keys[0]]['content']);
    }

    public function testDivClose()
    {
        $snippet = DivClose::make();

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('</div>', $snippet[$keys[0]]['content']);
    }

    public function testHrTag()
    {
        $snippet = HrTag::make();

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('<hr>', $snippet[$keys[0]]['content']);
    }

    public function testHeadingTag()
    {
        $snippet = Heading::make(
            [
            'content' => 'Billing Details'
            ]
        );

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('<h3>Billing Details</h3>', $snippet[$keys[0]]['content']);
    }

    public function testDivTag()
    {
        $snippet = Div::make(
            [
            'content' => '<p class="foo">Bar</p>'
            ]
        );

        $keys = array_keys($snippet);

        $this->assertEquals('html', $snippet[$keys[0]]['type']);
        $this->assertEquals('<div><p class="foo">Bar</p></div>', $snippet[$keys[0]]['content']);
    }
}
