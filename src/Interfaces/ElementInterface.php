<?php

namespace Spider\Interfaces;


interface ElementClassAttributeInterface {
    public function addClass(string ...$classes): self;

    public function removeClass(string ...$classes): self;

    public function hasClass(string $class): bool;
}

interface ElementIdAttributeInterface {
    public function addID(string $id): self;

    public function removeID(): self;

    public function hasID(string $id): bool;
}

interface ElementAttributeInterface extends 
    ElementClassAttributeInterface, 
    ElementIdAttributeInterface {
    public function attr(string $key = null): string|array;
}

interface ElementCleanerInterface {
    public function empty(): self;
    
    public function remove(): void;
}

interface ElementContentInterface {
    public function text(?string $value = null): string|bool;
    
    public function html(?string $value = null): string|bool;
}

interface ElementInterface extends 
    ElementAttributeInterface,
    ElementCleanerInterface,
    ElementContentInterface {}