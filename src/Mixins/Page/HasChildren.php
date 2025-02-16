<?php

namespace Spider\Mixins\Page;

use Spider\Element;


trait HasChildren {
    public function children(): array {
        return $this->nodes;
    }

    public function eq(int $index): ?Element {
        $node = $this->nodes[$index] ?? null;
        
        if (!$node) return $node;

        return new Element($node, $this->dom);
    }
}