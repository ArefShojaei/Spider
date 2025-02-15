<?php

namespace Spider;

use DOMDocument;
use DOMNode;


final class Element {
    private DOMNode $node;

    private DOMDocument $dom;


    public function __construct(DOMNode $node, DOMDocument $dom) {
        $this->node = $node;
        $this->dom = $dom;
    }

    public function text(): string {
        return $this->node->textContent;
    }

    public function html(): string {
        return $this->dom->saveHTML($this->node);
    }

    public function attr(string $key = null): string|array {
        $attributes = [];

        foreach ($this->node->attributes as $attribute) {
            if (isset($key) && $attribute->nodeName === $key) return $attribute->textContent;

            $attributes[$attribute->nodeName] = $attribute->nodeValue;
        }

        return $attributes;
    }
}