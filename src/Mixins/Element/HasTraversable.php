<?php

namespace Spider\Mixins\Element;

use DOMDocumentFragment;
use DOMElement;


trait HasTraversable {
    public function parent(): DOMElement {
        return $this->node->parentNode;
    }

    public function append(string $content): void {
        $fragmentNode = $this->createFragment($content);

        $this->node->appendChild($fragmentNode);
    }
    
    public function prepend(string $content): void {
        $fragmentNode = $this->createFragment($content);

        $this->node->prepend($fragmentNode);
    }
    
    public function after(string $content): void {
        $fragmentNode = $this->createFragment($content);

        $this->parent()->after($fragmentNode);
    }
    
    public function before(string $content): void {
        $fragmentNode = $this->createFragment($content);

        $this->parent()->before($fragmentNode);
    }

    private function createFragment(string $content): DOMDocumentFragment {
        $fragmentNode = $this->dom->createDocumentFragment();

        $fragmentNode->appendXML($content);

        return $fragmentNode;
    }
}