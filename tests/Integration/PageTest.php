<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Tests\Unit\SpiderTest;
use Spider\{
    Element,
    Page,
    Spider
};


final class PageTest extends TestCase {
    public const DIST_HTML_FILE = "page_test.html"; 


    /**
     * @test
     */
    public function getSpiderInstance(): Spider {
        return (new SpiderTest(Spider::class))->createInstance();
    }

    /**
     * @test
     * @depends getSpiderInstance
     */
    public function loadHtmlByUrlFromSpiderClass(Spider $spider): Page {
        $page = $spider->loadHTML(SpiderTest::HTML_URL);

        $this->assertInstanceOf(Page::class, $page);
        $this->assertIsString($page->display());

        return $page;
    }

    /**
     * @test
     * @depends getSpiderInstance
     */
    public function loadHtmlByFileFromSpiderClass(Spider $spider): Page {
        $path = dirname(__DIR__, 2) . "\\docs\\" . SpiderTest::HTML_FILE;

        $page = $spider->loadFile($path);

        $this->assertInstanceOf(Page::class, $page);
        $this->assertIsString($page->display());

        return $page;
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findTitleTagElementThatReturnsNodeElementFromElementClass(Page $page): void {
        $node = $page->find("title");

        $this->assertIsObject($node);
        $this->isInstanceOf(Element::class, $node);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function getHtmlContentOfCurrentPage(Page $page): void {
        $cotnent = $page->display();

        $this->assertIsString($cotnent);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findTitleTagElementThatReturnsHtmlContent(Page $page): void {
        $title = $page->find("title")->html();

        $this->assertIsString($title);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findTitleTagElementThatReturnsTextContent(Page $page): void {
        $title = $page->find("title")->text();

        $this->assertIsString($title);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findSpanTagElementThatSetsTextContentWithHelloWorldValue(Page $page): void {
        $value = "Hello World";

        $isSetTextContent = $page->find("p")->text($value);
        $currentTextcontent = $page->find("p")->text();

        $this->assertTrue($isSetTextContent);
        $this->assertStringContainsString($value, $currentTextcontent);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findSpanTagElementThatSetsHtmlContent(Page $page): void {
        $html = "<p>Hello World</p>";

        $isSetHtmlContent = $page->find("p")->html($html);
        $currentHtmlContent = $page->find("p")->html();

        $this->assertTrue($isSetHtmlContent);
        $this->assertStringContainsString($html, $currentHtmlContent);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findAnchorTagElementThatReturnsAttributes(Page $page): void {
        $attributes = $page->find("a")->attr();

        $this->assertIsArray($attributes);
    }
 
    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findAnchorTagElementThatReturnsLinkAttribute(Page $page): void {
        $link = $page->find("a")->attr("href");

        $this->assertIsString($link);
    }
 
    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findAnchorTagElementThatSetsDataAttributeWithOneValue(Page $page): void {
        $attribute = "data-info";
        $value = "HTML Anchor Element";
        
        $page->find("a")->attr($attribute, $value);
        
        $attributes = $page->find("a")->attr();

        $this->assertArrayHasKey($attribute, $attributes);
    }
 
    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findAnchorTagElementThatSetsClassAttribute(Page $page): void {
        $class = "spider";
        
        $page->find("a")->addClass($class);
        
        $attributes = $page->find("a")->attr();

        $this->assertStringContainsString($class, $attributes["class"]);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function findAnchorTagElementThatHasClassAttribute(Page $page): void {
        $class = "spider";
        
        $isSetClass = $page->find("a")->hasClass($class);
        
        $this->assertTrue($isSetClass);
    }

    /**
     * @test
     * @depends loadHtmlByFileFromSpiderClass
     */
    public function exportHtmlContent(Page $page): void {
        $path = dirname(__DIR__, 2) . "\\docs\\" . self::DIST_HTML_FILE;
        
        $isSavedFile = $page->export($path);

        $this->assertTrue($isSavedFile);
        $this->assertFileExists($path);
        $this->assertIsString(file_get_contents($path));
    }
}