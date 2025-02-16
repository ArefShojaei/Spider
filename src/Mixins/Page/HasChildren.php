<?php

namespace Spider\Mixins\Page;


trait HasChildren {
    public function children(): array {
        return $this->nodes;
    }
}