<?php

namespace Spider\Mixins\Page;

use Closure;
use Spider\Element;


trait HasIterable {
    public function each(Closure $callback): void {
        foreach ($this->nodes as $key => $node) {
            $nodeInstance = new Element($node, $this->dom);

            call_user_func($callback, $key, $nodeInstance);
        }
    }

    public function map(Closure $callback): array {
        $result = [];
        
        foreach ($this->nodes as $key => $node) {
            $nodeInstance = new Element($node, $this->dom);

            $result[] = call_user_func($callback, $key, $nodeInstance);
        }

        return $result;
    }

    public function filter(Closure $callback): array {
        return $this->map($callback);
    }
}