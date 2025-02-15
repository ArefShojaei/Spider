<?php

namespace Spider\Interfaces;


interface RequestInterface {
    public static function get(string $url): string|false;
}