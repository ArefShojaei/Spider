<?php

namespace Spider\Interfaces;


interface SelectorInterface {
    public static function convert(string $selector): string;
}