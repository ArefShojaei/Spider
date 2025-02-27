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
