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

    private array $nodes = [];

    private string $prefixSelector = "";


    public function find(string $selector): Element {
        $nodes = $this->query($selector);

        $node = $nodes->item(self::FIRST_ELEMENT_ITEM);

        return new Element($node, $this->dom);
    }

    public function findAll(string $selector): Page {
        $nodes = $this->query($selector);

        $this->prefixSelector = $selector;

        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }

        return $this;
    }

    /**
     * Select internal child node element
     * @param $selector child selector
     */
    public function select(string $selector, int $index): Element {
        $nodes = $this->query(trim("{$this->prefixSelector} {$selector}"));
    
        $node = $nodes->item($index);

        return new Element($node, $this->dom);
    }

    /**
     * @param $selector Css-selector
     */
    private function query(string $selector): DOMNodeList {
        $xpathSelector = Selector::convert($selector);
    
        return $this->xpath->query($xpathSelector);
    }
}