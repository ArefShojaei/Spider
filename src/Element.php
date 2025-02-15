<?php

namespace Spider;

use DOMDocument;
use DOMNode;
use Spider\Mixin\Element\{
    HasAttribute,
    HasCleaner,
    HasContent
};


final class Element {
    use HasAttribute, HasCleaner, HasContent;

    
    private DOMNode $node;

    private DOMDocument $dom;


    public function __construct(DOMNode $node, DOMDocument $dom) {
        $this->node = $node;
        $this->dom = $dom;
    }
}