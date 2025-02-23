<?php

namespace Spider\Interfaces;

use Closure;
use Spider\{
    Element,
    Page,
};


interface HasSearchableInterface {
    public function select(string $selector): Page|Element;
}

interface HasIterableInterface {
    public function each(Closure $callback): void;
    
    public function map(Closure $callback): array;
    
    public function filter(Closure $callback): array;
}

interface HasChildrenInterface {
    public function children(): array;
    
    public function eq(int $index): ?Element;

    public function first(): ?Element;
    
    public function last(): ?Element;
}

interface PageInterface extends 
    HasSearchableInterface, 
    HasIterableInterface,
    HasChildrenInterface {
        public function export(string $location): bool;
    }