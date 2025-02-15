<?php

namespace Spider;

use Spider\Interfaces\RequestInterface;


final class Request implements RequestInterface {
    public static function get(string $url): string|false {
        return @file_get_contents($url);
    }
}