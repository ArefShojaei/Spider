<?php

namespace Spider\Mixins\Page;

use DOMNodeList;
use Spider\{
    Element,
    Page,
    Selector
};


trait HasSearchable {
    private const FIRST_ELEMENT_ITEM = 0;

    private const SINGLE_ELMENT_FOUND_COUNT = 1;

    private array $nodes = [];


    private function find(DOMNodeList $nodes): Element {
        $node = $nodes->item(self::FIRST_ELEMENT_ITEM);

        return new Element($node, $this->dom);
    }

    private function findAll(DOMNodeList $nodes): Page {
        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }

        return $this;
    }

    /**
     * @param $selector Css-selector
     */
    public function select(string $selector): void {
        $xpathSelector = Selector::convert($selector);
    
        $nodes = $this->xpath->query($xpathSelector);

        count($nodes) > self::SINGLE_ELMENT_FOUND_COUNT ? $this->findAll($nodes) : $this->find($nodes);
    }
}