<?php

namespace Spider\Mixins\Page;

use DOMNode;
use Spider\Element;


trait HasChildren {
    public function children(): array {
        return $this->nodes;
    }

    public function eq(int $index): ?Element {
        $node = $this->getNodePosition(self::DEFAULT_ELEMENT_CHILD_WITH_INDEX)($index);
        
        return $this->setElementByPosition($node);
    }

    public function first(): ?Element {
        $node = $this->getNodePosition(self::FIRST_ELEMENT_CHILD)();
        
        return $this->setElementByPosition($node);
    }

    public function last(): ?Element {
        $node = $this->getNodePosition(self::LAST_ELEMENT_CHILD)();
        
        return $this->setElementByPosition($node);
    }

    private function getNodePosition(string $position): ?object {
        return match ($position) {
            self::FIRST_ELEMENT_CHILD => function() {
                return current($this->nodes) ?? null; 
            },
            self::LAST_ELEMENT_CHILD => function() {
                return end($this->nodes) ?? null; 
            },
            self::DEFAULT_ELEMENT_CHILD_WITH_INDEX => function(int $index) {
                return $this->nodes[$index] ?? null;
            },
        };
    }

    private function setElementByPosition(DOMNode $node): Element {
        if (!$node) return $node;

        return new Element($node, $this->dom);
    }
}