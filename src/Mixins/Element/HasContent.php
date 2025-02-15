<?php

namespace Spider\Mixin\Element;


trait HasContent {
    public function text(): string {
        return $this->node->textContent;
    }

    public function html(): string {
        return $this->dom->saveHTML($this->node);
    }
}