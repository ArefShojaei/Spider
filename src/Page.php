<?php

namespace Spider;

use DOMDocument;
use DOMXPath;
use Spider\Interfaces\PageInterface;
use Spider\Mixins\Page\{
    HasChildren,
    HasIterable,
    HasSelector
};


final class Page implements PageInterface {
    use HasSelector, HasIterable, HasChildren;


    private DOMDocument $dom;

    private DOMXPath $xpath;


    public function __construct(DOMDocument $dom, DOMXPath $xpath) {
        $this->dom = $dom;
        $this->xpath = $xpath;
    }

    public function export(string $location): bool {
        $html = trim($this->dom->saveHTML());
        
        $encodedHtmlContent = html_entity_decode($html, encoding:"UTF-8");

        return file_put_contents($location, $encodedHtmlContent);
    }
}
