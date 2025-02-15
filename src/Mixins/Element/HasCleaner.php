<?php

namespace Spider\Mixin\Element;


trait HasCleaner {
    public function empty(): self {
        $this->node->nodeValue = "";
        $this->node->textContent = "";

        return $this;
    }

    public function remove(): void {
        $this->node->parentNode->removeChild($this->node);
    }
}