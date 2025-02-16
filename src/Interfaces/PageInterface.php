<?php

namespace Spider\Interfaces;

use Closure;
use Spider\{
    Element,
    Page
};


interface HasSelectorInterface {
    public function find(string $selector): Element;
    
    public function findAll(string $selector): Page;
}

interface HasIterableInterface {
    public function each(Closure $callback): void;
    
    public function map(Closure $callback): array;
    
    public function filter(Closure $callback): array;
}

interface HasChildrenInterface {
    public function children(): array;
}

interface PageInterface extends 
    HasSelectorInterface, 
    HasIterableInterface,
    HasChildrenInterface {}