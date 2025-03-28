<?php

namespace Spider;

use DOMDocument;
use DOMXPath;
use Spider\Interfaces\PageInterface;
use Spider\Mixins\Page\{
    HasChildren,
    HasHTMLEncodable,
    HasIterable,
    HasSearchable,
};


final class Page implements PageInterface {
    use HasSearchable, HasIterable, HasChildren, HasHTMLEncodable;

    private const FIRST_ELEMENT_CHILD = "FIRST";
    
    private const LAST_ELEMENT_CHILD = "LAST";
    
    private const DEFAULT_ELEMENT_CHILD_WITH_INDEX = "DEFAULT";

    private const FIRST_ELEMENT_ITEM = 0;

    private array $nodes = [];

    private string $prefixSelector = "";
    

    private DOMDocument $dom;

    private DOMXPath $xpath;


    public function __construct(DOMDocument $dom, DOMXPath $xpath) {
        $this->dom = $dom;
        $this->xpath = $xpath;
    }

    public function display(): string {
        $html = trim($this->dom->saveHTML());
        
        $decodedHtmlContent = $this->decodeHTML($html);

        return $decodedHtmlContent;
    }

    public function export(string $location): bool {
        $html = trim($this->dom->saveHTML());
        
        $decodedHtmlContent = $this->decodeHTML($html);

        return file_put_contents($location, $decodedHtmlContent);
    }
}
