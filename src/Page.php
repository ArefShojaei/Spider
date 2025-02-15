<?php

namespace Spider;

use DOMDocument;
use DOMXPath;
use Spider\Interfaces\PageInterface;


final class Page implements PageInterface {
    private DOMDocument $dom;

    private DOMXPath $xpath;


    public function __construct(DOMDocument $dom, DOMXPath $xpath) {
        $this->dom = $dom;
        $this->xpath = $xpath;
    }

    public function find(string $selector): Element {
        $FIRST_ELEMENT = 0;

        $node = $this->xpath->query($selector)->item($FIRST_ELEMENT);

        return new Element($node, $this->dom);
    }
}
