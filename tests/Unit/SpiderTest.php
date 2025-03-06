<?php

namespace Tests\Unit;

use Spider\Spider;
use PHPUnit\Framework\TestCase;
use Spider\Page;


final class SpiderTest extends TestCase {
    private const INTERFACE_IMPLEMENTED_COUNT = 2;
    
    private const HTML_URL = "http://imdb.com";
    
    private const HTML_FILE = "page.html";


    /**
     * @test
     */
    public function createInstance(): Spider {
        $instance = new Spider;

        $this->assertInstanceOf(Spider::class, $instance);

        return $instance;
    }

    /**
     * @test
     */
    public function implementInterfaces(): void {
        $interfaces = class_implements(Spider::class);

        $this->assertCount(self::INTERFACE_IMPLEMENTED_COUNT, $interfaces);
    }

    /**
     * @test
     * @depends createInstance
     */
    public function loadHtmlByUrlThatReturnsPageInstance(Spider $spider): void {
        $page = $spider->loadHTML(self::HTML_URL);

        $this->assertInstanceOf(Page::class, $page);
    }

    /**
     * @test
     * @depends createInstance
     */
    public function loadHtmlByFileThatReturnsPageInstance(Spider $spider): void {
        $path = dirname(__DIR__, 2) . "\\docs\\" . self::HTML_FILE;
        
        $page = $spider->loadFile($path);

        $this->assertInstanceOf(Page::class, $page);
    }
}