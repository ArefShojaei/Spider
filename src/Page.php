<?php

namespace Spider;

use Closure;
use DOMDocument;
use DOMXPath;
use Spider\Interfaces\PageInterface;


final class Page implements PageInterface {
    private DOMDocument $dom;

    private DOMXPath $xpath;

    private array $nodes = [];


    public function __construct(DOMDocument $dom, DOMXPath $xpath) {
        $this->dom = $dom;
        $this->xpath = $xpath;
    }

    public function find(string $selector): Element {
        $FIRST_ELEMENT = 0;

        $node = $this->xpath->query($selector)->item($FIRST_ELEMENT);

        return new Element($node, $this->dom);
    }

    public function findAll(string $selector): self {
        $nodes = $this->xpath->query($selector);
    
        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }

        return $this;
    }
}
