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

    public function addClass(string ...$classes): self {
        $currentClasses = $this->node->getAttribute("class");
    
        $newClasses = trim($currentClasses . " " . implode(" ", $classes));

        $this->node->setAttribute("class", $newClasses);
    

        return $this;
    }

    public function removeClass(string ...$classes): self {
        $currentClasses = $this->node->getAttribute("class");

        $newClasses = "";

        foreach ($classes as $class) {
            $newClasses = str_replace($class, "", $currentClasses);
        }

        $this->node->setAttribute("class", trim($newClasses));


        return $this;
    }

    public function hasClass(string $class): bool {
        $currentClasses = $this->node->getAttribute("class");
        
        $classes = explode(" ", $currentClasses);

        return in_array($class, $classes) ? true : false;
    }

    public function addID(string $id): self {
        $this->node->setAttribute("id", $id);

        return $this;
    }

    public function removeID(): self {
        $this->node->removeAttribute("id");

        return $this;
    }

    public function hasID(string $id): bool {
        $currentID = $this->node->getAttribute("id");
        
        if (!$currentID) return false;

        return $currentID === $id ? true : false;
    }

    public function empty(): self {
        $this->node->nodeValue = "";
        $this->node->textContent = "";

        return $this;
    }

    public function remove(): void {
        $this->node->parentNode->removeChild($this->node);
    }
}