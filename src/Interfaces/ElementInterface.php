<?php

namespace Spider\Interfaces;


interface ElementAttributeInterface {
    public function attr(string $key = null): string|array;

    public function addClass(string ...$classes): self;

    public function removeClass(string ...$classes): self;

    public function hasClass(string $class): bool;

    public function addID(string $id): self;

    public function removeID(): self;

    public function hasID(string $id): bool;
}

interface ElementCleanerInterface {
    public function empty(): self;
    
    public function remove(): void;
}

interface ElementContentInterface {
    public function text(): string;
    
    public function html(): string;
}

interface ElementInterface extends 
    ElementAttributeInterface,
    ElementCleanerInterface,
    ElementContentInterface {}