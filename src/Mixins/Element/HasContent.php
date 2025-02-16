<?php

namespace Spider\Mixins\Element;


trait HasContent {
    public function text(): string {
        return trim($this->node->textContent);
    }

    public function html(): string {
        return trim($this->dom->saveHTML($this->node));
    }
}