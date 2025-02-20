<?php

namespace Spider\Mixins\Page;

use Spider\{
    Element,
    Page
};


trait HasSearchable {
    private array $nodes = [];

    public function find(string $selector): Element {
        $FIRST_ELEMENT = 0;

        $node = $this->xpath->query($selector)->item($FIRST_ELEMENT);

        return new Element($node, $this->dom);
    }

    public function findAll(string $selector): Page {
        $nodes = $this->xpath->query($selector);
    
        foreach ($nodes as $node) {
            $this->nodes[] = $node;
        }

        return $this;
    }
}