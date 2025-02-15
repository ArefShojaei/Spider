<?php

namespace Spider;

use DOMDocument;
use DOMNode;
use Spider\Mixins\Element\{
    HasAttribute,
    HasCleaner,
    HasContent
};
use Spider\Interfaces\ElementInterface;


final class Element implements ElementInterface {
    use HasAttribute, HasCleaner, HasContent;

    
    private DOMNode $node;

    private DOMDocument $dom;


    public function __construct(DOMNode $node, DOMDocument $dom) {
        $this->node = $node;
        $this->dom = $dom;
    }
}