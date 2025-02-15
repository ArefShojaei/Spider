<?php

namespace Spider\Interfaces;

use Spider\Element;


interface PageInterface {
    public function find(string $selector): Element;
}